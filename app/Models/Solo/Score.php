<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

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

    const PROCESSING_QUEUE = 'osu-queue:score-statistics';

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

    /**
     * This should match the one used in osu-elastic-indexer.
     */
    public function scopeIndexable(Builder $query): Builder
    {
        return $query
            ->where('preserve', true)
            ->whereHas('user', fn (Builder $q): Builder => $q->default());
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
            'legacy_perfect' => null,

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

    public function createLegacyEntryOrExplode()
    {
        $score = $this->makeLegacyEntry();

        $score->saveOrExplode();

        return $score;
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
        $scoreClass = LegacyScore\Model::getClass($this->getMode());

        $score = new $scoreClass([
            'beatmap_id' => $this->beatmap_id,
            'beatmapset_id' => $this->beatmap?->beatmapset_id ?? 0,
            'countmiss' => $statistics->miss,
            'enabled_mods' => app('mods')->idsToBitset(array_column($data->mods, 'acronym')),
            'maxcombo' => $this->max_combo,
            'pass' => $this->passed,
            'perfect' => $this->passed && $statistics->miss + $statistics->large_tick_miss === 0,
            'rank' => $this->rank,
            'score' => $this->total_score,
            'scorechecksum' => "\0",
            'user_id' => $this->user_id,
        ]);

        switch (Beatmap::modeStr($this->ruleset_id)) {
            case 'osu':
                $score->count300 = $statistics->great;
                $score->count100 = $statistics->ok;
                $score->count50 = $statistics->meh;
                break;
            case 'taiko':
                $score->count300 = $statistics->great;
                $score->count100 = $statistics->ok;
                break;
            case 'fruits':
                $score->count300 = $statistics->great;
                $score->count100 = $statistics->large_tick_hit;
                $score->countkatu = $statistics->small_tick_miss;
                $score->count50 = $statistics->small_tick_hit;
                break;
            case 'mania':
                $score->countgeki = $statistics->perfect;
                $score->count300 = $statistics->great;
                $score->countkatu = $statistics->good;
                $score->count100 = $statistics->ok;
                $score->count50 = $statistics->meh;
                break;
        }

        return $score;
    }

    public function queueForProcessing(): void
    {
        LaravelRedis::lpush(static::PROCESSING_QUEUE, json_encode([
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
        return UserRank::getRank(ScoreSearchParams::fromArray(array_merge($params ?? [], [
            'beatmap_ids' => [$this->beatmap_id],
            'before_score' => $this,
            'is_legacy' => $this->isLegacy(),
            'ruleset_id' => $this->ruleset_id,
            'user' => $this->user,
        ])));
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'Cheating',
            'user_id' => $this->user_id,
        ];
    }
}
