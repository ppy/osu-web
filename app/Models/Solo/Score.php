<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Libraries\Score\UserRank;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Score as LegacyScore;
use App\Models\ScoreToken;
use App\Models\Traits;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelRedis;
use Storage;

/**
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property \stdClass $data
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $id
 * @property bool $preserve
 * @property int $ruleset_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class Score extends Model implements Traits\ReportableInterface
{
    use Traits\Reportable, Traits\WithWeightedPp;

    const PROCESSING_QUEUE = 'osu-queue:score-statistics';

    protected $casts = [
        'data' => ScoreData::class,
        'has_replay' => 'boolean',
        'preserve' => 'boolean',
    ];

    protected $table = 'solo_scores';

    public static function createFromJsonOrExplode(array $params)
    {
        $score = new static([
            'beatmap_id' => $params['beatmap_id'],
            'ruleset_id' => $params['ruleset_id'],
            'user_id' => $params['user_id'],
            'data' => $params,
        ]);

        $score->data->assertCompleted();

        // this should potentially just be validation rather than applying this logic here, but
        // older lazer builds potentially submit incorrect details here (and we still want to
        // accept their scores.
        if (!$score->data->passed) {
            $score->data->rank = 'D';
        }

        $score->saveOrExplode();

        return $score;
    }

    public static function extractParams(array $params, ScoreToken|MultiplayerScoreLink $scoreToken): array
    {
        return [
            ...get_params($params, null, [
                'accuracy:float',
                'max_combo:int',
                'maximum_statistics:array',
                'passed:bool',
                'rank:string',
                'statistics:array',
                'total_score:int',
            ]),
            'beatmap_id' => $scoreToken->beatmap_id,
            'build_id' => $scoreToken->build_id,
            'ended_at' => json_time(Carbon::now()),
            'mods' => app('mods')->parseInputArray($scoreToken->ruleset_id, get_arr($params['mods'] ?? null) ?? []),
            'ruleset_id' => $scoreToken->ruleset_id,
            'started_at' => $scoreToken->created_at_json,
            'user_id' => $scoreToken->user_id,
        ];
    }

    /**
     * Queue the item for score processing
     *
     * @param array $scoreJson JSON of the score generated using ScoreTransformer of type Solo
     */
    public static function queueForProcessing(array $scoreJson): void
    {
        LaravelRedis::lpush(static::PROCESSING_QUEUE, json_encode([
            'Score' => [
                'beatmap_id' => $scoreJson['beatmap_id'],
                'id' => $scoreJson['id'],
                'ruleset_id' => $scoreJson['ruleset_id'],
                'user_id' => $scoreJson['user_id'],
                // TODO: processor is currently order dependent and requires
                // this to be located at the end
                'data' => json_encode($scoreJson),
            ],
        ]));
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function performance()
    {
        return $this->hasOne(ScorePerformance::class, 'score_id');
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
            : $query->where('data->passed', true);
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
            'beatmap_id',
            'id',
            'ruleset_id',
            'user_id' => $this->getRawAttribute($key),

            'data' => $this->getClassCastableAttributeValue($key, $this->getRawAttribute($key)),

            'has_replay',
            'preserve' => (bool) $this->getRawAttribute($key),

            'created_at',
            'updated_at' => $this->getTimeFast($key),

            'created_at_json',
            'updated_at_json' => $this->getJsonTimeFast($key),

            'pp' => $this->performance?->pp,

            'beatmap',
            'performance',
            'reportedIn',
            'user' => $this->getRelationValue($key),
        };
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
        return Storage::disk(config('osu.score_replays.storage').'-solo-replay')
            ->get($this->getKey());
    }

    public function isLegacy(): bool
    {
        return $this->data->buildId === null;
    }

    public function legacyScore(): ?LegacyScore\Best\Model
    {
        $id = $this->data->legacyScoreId;

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
            'maxcombo' => $data->maxCombo,
            'pass' => $data->passed,
            'perfect' => $data->passed && $statistics->miss + $statistics->large_tick_miss === 0,
            'rank' => $data->rank,
            'score' => $data->totalScore,
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
