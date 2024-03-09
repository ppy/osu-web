<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Enums\Ruleset;
use App\Enums\ScoreRank;
use App\Exceptions\InvariantException;
use App\Libraries\Score\UserRank;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Score as LegacyScore;
use App\Models\ScoreToken;
use App\Models\Traits;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LaravelRedis;
use Storage;

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
    use Traits\Reportable, Traits\WithWeightedPp;

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
        ];
        unset(
            $params['maximum_statistics'],
            $params['mods'],
            $params['statistics'],
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

        $beatmap = $scoreToken->beatmap;
        // anything that have leaderboard
        $params['ranked'] = $beatmap !== null && $beatmap->approved > 0;

        $params['preserve'] = $params['passed'] ?? false;

        return $params;
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->whereHas('beatmap.beatmapset');
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
        return $query
            // ensure correct index is used
            ->from(\DB::raw("{$this->getTable()} FORCE INDEX (user_ruleset_index)"))
            ->default()
            ->forRuleset($ruleset)
            ->includeFails($includeFails)
            // 1 day (24 * 3600)
            ->where('unix_updated_at', '>', time() - 86_400);
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

            'beatmap',
            'performance',
            'reportedIn',
            'user' => $this->getRelationValue($key),
        };
    }

    public function assertCompleted(): void
    {
        if (ScoreRank::tryFrom($this->rank ?? '') === null) {
            throw new InvariantException("'{$this->rank}' is not a valid rank.");
        }

        foreach (['total_score', 'accuracy', 'max_combo', 'passed'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("field missing: '{$field}'");
            }
        }

        if ($this->data->statistics->isEmpty()) {
            throw new InvariantException("field cannot be empty: 'statistics'");
        }
    }

    public function getMode(): string
    {
        return Beatmap::modeStr($this->ruleset_id);
    }

    public function getReplayFile(): ?string
    {
        return Storage::disk($GLOBALS['cfg']['osu']['score_replays']['storage'].'-solo-replay')
            ->get($this->getKey());
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
            if ($hits !== $maxHits) {
                return false;
            }

            if ($statistics->good / $maxHits >= 0.1) {
                return false;
            }

            return true;
        }

        return null;
    }

    public function legacyScore(): ?LegacyScore\Best\Model
    {
        $id = $this->legacy_score_id;

        return $id === null
            ? null
            : LegacyScore\Best\Model::getClass($this->getMode())::find($id);
    }

    public function makeLegacyEntry(): LegacyScore\Model
    {
        $data = $this->data;
        $statistics = $data->statistics;
        $legacyId = $this->legacy_score_id;
        $scoreClass = ($legacyId === null && $this->passed) || $legacyId > 0
            ? LegacyScore\Best\Model::getClass($this->getMode())
            : LegacyScore\Model::getClass($this->getMode());

        $score = new $scoreClass([
            'beatmap_id' => $this->beatmap_id,
            'beatmapset_id' => $this->beatmap?->beatmapset_id ?? 0,
            'countmiss' => $statistics->miss,
            'date' => $this->ended_at_json,
            'enabled_mods' => app('mods')->idsToBitset(array_column($data->mods, 'acronym')),
            'maxcombo' => $this->max_combo,
            'pass' => $this->passed,
            'perfect' => $this->legacy_perfect ?? $this->is_perfect_combo,
            'pp' => $this->pp,
            'replay' => $this->has_replay,
            'score' => $this->legacy_total_score,
            'scorechecksum' => "\0",
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
}
