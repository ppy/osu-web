<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Enums\Ruleset;
use App\Enums\ScoreRank;
use App\Exceptions\InvariantException;
use App\Interfaces\ScoreReplayFileInterface;
use App\Libraries\Score\LegacyReplayFile;
use App\Libraries\Score\ReplayFile;
use App\Libraries\Score\ScoringMode;
use App\Libraries\Score\UserRank;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Count;
use App\Models\Model;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Score as LegacyScore;
use App\Models\ScoreToken;
use App\Models\Traits;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use LaravelRedis;

/**
 * @property float $accuracy
 * @property int $beatmap_id
 * @property int $build_id
 * @property ScoreData $data
 * @property \Carbon\Carbon|null $ended_at
 * @property string|null $ended_at_json
 * @property bool $has_replay
 * @property int $id
 * @property int $legacy_score_id
 * @property int $legacy_total_score
 * @property int $max_combo
 * @property bool $passed
 * @property float $pp
 * @property bool $preserve
 * @property string $rank
 * @property bool $ranked
 * @property int $ruleset_id
 * @property \Carbon\Carbon|null $started_at
 * @property string|null $started_at_json
 * @property int $total_score
 * @property int $unix_updated_at
 * @property User $user
 * @property int $user_id
 */
class Score extends Model implements Traits\ReportableInterface
{
    use Traits\Reportable, Traits\WithDbCursorHelper, Traits\WithWeightedPp;

    const DEFAULT_SORT = 'old';

    const SORTS = [
        'old' => [['column' => 'id', 'order' => 'ASC']],
    ];

    public $timestamps = false;

    protected $casts = [
        'data' => ScoreData::class,
        'ended_at' => 'datetime',
        'has_replay' => 'boolean',
        'passed' => 'boolean',
        'preserve' => 'boolean',
        'ranked' => 'boolean',
        'started_at' => 'datetime',
    ];

    public static function createFromJsonOrExplode(array $params): static
    {
        $params['data'] = [
            'maximum_statistics' => $params['maximum_statistics'] ?? [],
            'mods' => $params['mods'] ?? [],
            'statistics' => $params['statistics'] ?? [],
            'total_score_without_mods' => $params['total_score_without_mods'] ?? null,
        ];
        unset(
            $params['maximum_statistics'],
            $params['mods'],
            $params['statistics'],
            $params['total_score_without_mods'],
        );

        $score = new static($params);

        $score->assertCompleted();

        // this should potentially just be validation rather than applying this logic here, but
        // older lazer builds potentially submit incorrect details here (and we still want to
        // accept their scores.
        if (!$score->passed) {
            $score->rank = 'F';
        }

        $score->saveOrExplode();

        return $score;
    }

    public static function extractParams(array $rawParams, ScoreToken|MultiplayerScoreLink $scoreToken): array
    {
        $params = get_params($rawParams, null, [
            'accuracy:float',
            'max_combo:int',
            'maximum_statistics:array',
            'mods:array',
            'passed:bool',
            'rank:string',
            'statistics:array',
            'total_score:int',
            'total_score_without_mods:int',
        ]);

        $params['maximum_statistics'] ??= [];
        $params['statistics'] ??= [];

        $params['mods'] = app('mods')->parseInputArray($scoreToken->ruleset_id, $params['mods'] ?? []);

        $params['beatmap_id'] = $scoreToken->beatmap_id;
        $params['build_id'] = $scoreToken->build_id;
        $params['ended_at'] = new \DateTime();
        $params['ruleset_id'] = $scoreToken->ruleset_id;
        $params['started_at'] = $scoreToken->created_at;
        $params['user_id'] = $scoreToken->user_id;

        $params['passed'] ??= false;
        $params['preserve'] = $params['passed'];

        $beatmap = $scoreToken->beatmap;
        // anything that have leaderboard
        $params['ranked'] = $params['passed'] && $beatmap !== null && $beatmap->approved > 0;

        return $params;
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function build()
    {
        return $this->belongsTo(Build::class, 'build_id');
    }

    public function legacyScore(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'legacy_score_type', 'legacy_best_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function processHistory()
    {
        return $this->hasOne(ScoreProcessHistory::class, 'score_id');
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->whereHas('beatmap.beatmapset');
    }

    /**
     * This should only be sorted by primary key(s)
     */
    public function scopeForListing(Builder $query): Builder
    {
        return $query->where('ranked', true)
            ->whereHas('user', fn ($q) => $q->default())
            ->from(\DB::raw("{$this->getTable()} FORCE INDEX (PRIMARY)"))
            ->leftJoinRelation('processHistory')
            ->select([$query->qualifyColumn('*'), 'processed_version']);
    }

    public function scopeForRuleset(Builder $query, string $ruleset): Builder
    {
        return $query->where('ruleset_id', Beatmap::MODES[$ruleset]);
    }

    public function scopeIncludeFails(Builder $query, bool $includeFails): Builder
    {
        return $includeFails
            ? $query
            : $query->where('passed', true);
    }

    /**
     * This should match the one used in osu-elastic-indexer.
     */
    public function scopeIndexable(Builder $query): Builder
    {
        return $query
            ->where('preserve', true)
            ->where('ranked', true)
            ->whereHas('user', fn (Builder $q): Builder => $q->default());
    }

    /**
     * This should only be used for user recent scores, not anything else
     */
    public function scopeRecent(Builder $query, string $ruleset, bool $includeFails): Builder
    {
        $minTime = CarbonImmutable::now()->subDays(1);

        return $query
            // ensure correct index is used
            ->from(\DB::raw("{$this->getTable()} FORCE INDEX (user_ruleset_index)"))
            ->default()
            ->forRuleset($ruleset)
            ->includeFails($includeFails)
            // unix_updated_at may be updated arbitrarily, so also filter by `ended_at` to ensure
            // only recent scores are returned.
            ->where('ended_at', '>', $minTime)
            // we still want to filter by `unix_updated_at` to make the query efficient (is in the PK).
            ->where('unix_updated_at', '>', $minTime->getTimestamp())
            // ensure correct partition in production
            ->where('preserve', '>=', 0);
    }

    public function scopeVisibleUsers(Builder $query): Builder
    {
        return $query->whereHas('user', fn ($userQuery) => $userQuery->default());
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'accuracy',
            'beatmap_id',
            'build_id',
            'id',
            'legacy_score_id',
            'legacy_total_score',
            'max_combo',
            'pp',
            'ruleset_id',
            'total_score',
            'unix_updated_at',
            'user_id' => $this->getRawAttribute($key),

            'rank' => $this->getRawAttribute($key) ?? 'F',

            'data' => $this->getClassCastableAttributeValue($key, $this->getRawAttribute($key)),

            'has_replay',
            'passed',
            'preserve' => (bool) $this->getRawAttribute($key),

            'ranked' => (bool) ($this->getRawAttribute($key) ?? true),

            'ended_at',
            'started_at' => $this->getTimeFast($key),

            'ended_at_json',
            'started_at_json' => $this->getJsonTimeFast($key),

            'best_id' => null,

            'is_perfect_combo' => $this->isPerfectCombo(),
            'legacy_perfect' => $this->isPerfectLegacyCombo(),

            'legacy_best_id' => $this->getLegacyBestId(),
            'legacy_score_type' => $this->getLegacyScoreType(),

            'beatmap',
            'build',
            'legacyScore',
            'performance',
            'processHistory',
            'reportedIn',
            'user' => $this->getRelationValue($key),
        };
    }

    #[\Override]
    public function getAttributeFromArray($key)
    {
        return match ($key) {
            'legacy_best_id',
            'legacy_score_type' => $this->getAttribute($key),
            default => parent::getAttributeFromArray($key),
        };
    }

    public function assertCompleted(): void
    {
        if (ScoreRank::tryFrom($this->rank ?? '') === null) {
            throw new InvariantException("'{$this->rank}' is not a valid rank.");
        }

        if ($this->accuracy === null || $this->accuracy < 0 || $this->accuracy > 1) {
            throw new InvariantException('Invalid accuracy.');
        }

        // int (as per es schema)
        if ($this->total_score === null || $this->total_score <= 0 || $this->total_score > 2147483647) {
            throw new InvariantException('Invalid total_score.');
        }

        // int (no data type enforcement as this goes into the json, but just to match total_score)
        if (
            $this->data->totalScoreWithoutMods !== null
            && ($this->data->totalScoreWithoutMods < 0 || $this->data->totalScoreWithoutMods > 2147483647)
        ) {
            throw new InvariantException('Invalid total_score_without_mods.');
        }

        foreach (['max_combo', 'passed'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("field missing: '{$field}'");
            }
        }

        if ($this->data->statistics->isEmpty()) {
            throw new InvariantException("field cannot be empty: 'statistics'");
        }

        app('mods')->assertValidExclusivity(
            $this->ruleset_id,
            array_column($this->data->mods, 'acronym')
        );
    }

    public function getClassicTotalScore(): int
    {
        return ScoringMode::convertToClassic(
            Ruleset::from($this->ruleset_id),
            $this->total_score,
            $this->maxBasicJudgements(),
        );
    }

    public function getMode(): string
    {
        return Beatmap::modeStr($this->ruleset_id);
    }

    public function isLegacy(): bool
    {
        return $this->legacy_score_id !== null;
    }

    public function isPerfectCombo(): bool
    {
        return $this->passed && $this->max_combo === $this->maxAchievableCombo();
    }

    /**
     * Only returns anything if different from isPerfectCombo
     */
    public function isPerfectLegacyCombo(): ?bool
    {
        // This is best effort as there's no way to re-generate the correct
        // value short of checking the source legacy score.
        if ($this->ruleset_id === Ruleset::mania->value) {
            if (!$this->passed) {
                return false;
            }

            static $noPerfect = [
                'combo_break',
                'large_tick_miss',
                'meh',
                'miss',
                'ok',
            ];

            $statistics = $this->data->statistics;
            foreach ($noPerfect as $field) {
                if ($statistics->$field !== 0) {
                    return false;
                }
            }

            $hits = $statistics->good + $statistics->great + $statistics->perfect;
            $maxHits = $this->data->maximumStatistics->perfect;
            if ($hits !== $maxHits || $maxHits === 0) {
                return false;
            }

            if ($statistics->good / $maxHits >= 0.1) {
                return false;
            }

            return true;
        }

        return null;
    }

    /**
     * The value is only accurate if the instance was fetched with `forListing` scope
     */
    public function isProcessed(): ?bool
    {
        if ($this->legacy_score_id !== null) {
            return true;
        }

        if (array_key_exists('processed_version', $this->attributes)) {
            return $this->attributes['processed_version'] !== null;
        }

        $lastProcessedScoreId = request_attribute_remember(
            'last_processed_score_id',
            fn (): int => Count::lastProcessedScoreId()->count,
        );

        return $this->getKey() <= $lastProcessedScoreId;
    }

    public function makeLegacyEntry(): LegacyScore\Model
    {
        $data = $this->data;
        $statistics = $data->statistics;
        $legacyId = $this->legacy_score_id;
        $scoreClass = ($legacyId === null && $this->passed) || $legacyId > 0
            ? LegacyScore\Best\Model::getClass($this->getMode())
            : LegacyScore\Model::getClass($this->getMode());

        // Only attributes available to best model (and `pass`).
        $score = new $scoreClass([
            'beatmap_id' => $this->beatmap_id,
            'countmiss' => $statistics->miss,
            'date' => $this->ended_at_json,
            'enabled_mods' => app('mods')->idsToBitset(array_column($data->mods, 'acronym')),
            'maxcombo' => $this->max_combo,
            'pass' => $this->passed,
            'perfect' => $this->legacy_perfect ?? $this->is_perfect_combo,
            'pp' => $this->pp,
            'replay' => $this->has_replay,
            'score' => $this->legacy_total_score,
            'user_id' => $this->user_id,
        ]);

        switch (Ruleset::from($this->ruleset_id)) {
            case Ruleset::osu:
                $score->count300 = $statistics->great;
                $score->count100 = $statistics->ok;
                $score->count50 = $statistics->meh;
                break;
            case Ruleset::taiko:
                $score->count300 = $statistics->great;
                $score->count100 = $statistics->ok;
                break;
            case Ruleset::catch:
                $score->count300 = $statistics->great;
                $score->count100 = $statistics->large_tick_hit;
                $score->countkatu = $statistics->small_tick_miss;
                $score->count50 = $statistics->small_tick_hit;
                break;
            case Ruleset::mania:
                $score->countgeki = $statistics->perfect;
                $score->count300 = $statistics->great;
                $score->countkatu = $statistics->good;
                $score->count100 = $statistics->ok;
                $score->count50 = $statistics->meh;
                break;
        }

        $score->recalculateRank();

        return $score;
    }

    public function maxAchievableCombo(): int
    {
        $ret = 0;

        /**
         * References:
         * - https://github.com/ppy/osu/wiki/Scoring
         * - https://github.com/ppy/osu/blob/012039ff90a2bf234418caef81792af0ffb4d123/osu.Game/Scoring/ScoreInfoExtensions.cs#L29-L34
         * - https://github.com/ppy/osu/blob/012039ff90a2bf234418caef81792af0ffb4d123/osu.Game/Rulesets/Scoring/HitResult.cs#L179-L202
         */
        static $affectsCombo = [
            // 'miss',
            'meh',
            'ok',
            'good',
            'great',
            'perfect',
            'large_tick_hit',
            // 'large_tick_miss',
            'legacy_combo_increase',
            // 'combo_break',
            'slider_tail_hit',
        ];

        $maximumStatistics = $this->data->maximumStatistics;
        foreach ($affectsCombo as $field) {
            $ret += $maximumStatistics->$field;
        }

        return $ret;
    }

    public function queueForProcessing(): void
    {
        LaravelRedis::lpush($GLOBALS['cfg']['osu']['scores']['processing_queue'], json_encode([
            'Score' => $this->getAttributes(),
        ]));
    }

    public function replayFile(): ?ScoreReplayFileInterface
    {
        return $this->has_replay
            ? (
                $this->isLegacy()
                    ? new LegacyReplayFile($this->legacyScore)
                    : new ReplayFile($this)
            ) : null;
    }

    public function trashed(): bool
    {
        return false;
    }

    public function url(): string
    {
        return route('scores.show', ['rulesetOrScore' => $this->getKey()]);
    }

    public function userRank(?array $params = null): int
    {
        if (!$this->ranked || !$this->preserve) {
            return 0;
        }

        // Non-legacy score always has its rank checked against all score types.
        if (!$this->isLegacy()) {
            $params['is_legacy'] = null;
        }

        return UserRank::getRank(ScoreSearchParams::fromArray([
            ...($params ?? []),
            'beatmap_ids' => [$this->beatmap_id],
            'before_score' => $this,
            'ruleset_id' => $this->ruleset_id,
            'user' => $this->user,
        ]));
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'Cheating',
            'user_id' => $this->user_id,
        ];
    }

    private function getLegacyBestId(): ?int
    {
        $bestId = $this->legacy_score_id;

        return $bestId === null || $bestId === 0 ? null : $bestId;
    }

    private function getLegacyScoreType(): string
    {
        return 'score_best_'.Beatmap::modeStr($this->ruleset_id);
    }

    /**
     * Shortcut for calculating the beatmap's object count using only the score.
     *
     * @see https://github.com/ppy/osu/blob/b535f7c51916ed09231b78aa422e6488cf9a2a12/osu.Game/Scoring/Legacy/ScoreInfoExtensions.cs#L28-L32 Client reference
     * @see https://github.com/ppy/osu/blob/b535f7c51916ed09231b78aa422e6488cf9a2a12/osu.Game/Rulesets/Scoring/HitResult.cs#L228-L243 Client reference (IsBasic)
     */
    private function maxBasicJudgements(): int
    {
        static $basicHitResults = [
            'none',
            'miss',
            'meh',
            'ok',
            'good',
            'great',
            'perfect',
        ];

        $count = 0;
        $maximumStatistics = $this->data->maximumStatistics;

        foreach ($basicHitResults as $field) {
            $count += $maximumStatistics->$field;
        }

        return $count;
    }
}
