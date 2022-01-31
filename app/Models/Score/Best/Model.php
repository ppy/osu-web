<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score\Best;

use App\Libraries\ReplayFile;
use App\Models\Beatmap;
use App\Models\BeatmapModeStats;
use App\Models\Country;
use App\Models\ReplayViewCount;
use App\Models\Score\Model as BaseModel;
use App\Models\Traits;
use App\Models\User;
use Datadog;
use DB;
use Exception;
use GuzzleHttp\Client;

/**
 * @property User $user
 */
abstract class Model extends BaseModel
{
    use Traits\Reportable, Traits\WithDbCursorHelper;

    public $position = null;
    public ?float $weight = null;

    protected $macros = [
        'accurateRankCounts',
        'forListing',
        'userBest',
    ];

    const SORTS = [
        'score_asc' => [
            ['column' => 'score', 'order' => 'ASC'],
            ['column' => 'score_id', 'columnInput' => 'id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'score_asc';

    const RANK_TO_STATS_COLUMN_MAPPING = [
        'A' => 'a_rank_count',
        'S' => 's_rank_count',
        'SH' => 'sh_rank_count',
        'X' => 'x_rank_count',
        'XH' => 'xh_rank_count',
    ];

    public static function queueIndexingForUser(User $user)
    {
        $instance = new static();
        $table = $instance->getTable();
        $modeId = Beatmap::MODES[static::getMode()];

        $instance->getConnection()->insert(
            "INSERT INTO score_process_queue (score_id, mode, status) SELECT score_id, {$modeId}, 1 FROM {$table} WHERE user_id = {$user->getKey()}"
        );
    }

    public function replayFile(): ?ReplayFile
    {
        if ($this->replay) {
            return new ReplayFile($this);
        }

        return null;
    }

    public function weightedPp(): ?float
    {
        return $this->weight === null ? null : $this->weight * $this->pp;
    }

    public function macroForListing()
    {
        return function ($query) {
            $limit = config('osu.beatmaps.max-scores');
            $newQuery = (clone $query)->with('user')->limit($limit * 3);

            $result = [];
            $offset = 0;
            $baseResultCount = 0;
            $finalize = function (array $result) {
                return array_values($result);
            };

            while (true) {
                $baseResult = $newQuery->offset($offset)->get();
                $baseResultCount = count($baseResult);

                if ($baseResultCount === 0) {
                    break;
                }

                $offset += $baseResultCount;

                foreach ($baseResult as $entry) {
                    if (isset($result[$entry->user_id])) {
                        continue;
                    }

                    $result[$entry->user_id] = $entry;

                    if (count($result) >= $limit) {
                        return $finalize($result);
                    }
                }
            }

            return $finalize($result);
        };
    }

    public function userRank($options)
    {
        // laravel model has a $hidden property
        if ($this->getAttribute('hidden')) {
            return;
        }

        if ($options['cached'] ?? true) {
            $rank = $this->userRankCached($options);

            if ($rank !== null && $rank > 50) {
                return $rank;
            }
        }

        $query = static
            ::where('beatmap_id', '=', $this->beatmap_id)
            ->cursorSort('score_asc', [
                'score' => $this->score,
                'id' => $this->getKey(),
            ]);

        if (isset($options['type'])) {
            $query->withType($options['type'], ['user' => $this->user]);
        }

        if (isset($options['mods'])) {
            $query->withMods($options['mods']);
        }

        $countQuery = DB::raw('DISTINCT user_id');

        return 1 + $query->visibleUsers()->default()->count($countQuery);
    }

    public function userRankCached($options)
    {
        $ddPrefix = config('datadog-helper.prefix_web').'.user_rank_cached_lookup';

        $server = config('osu.scores.rank_cache.server_url');

        if ($server === null || !empty($options['mods']) || ($options['type'] ?? 'global') !== 'global') {
            Datadog::increment("{$ddPrefix}.miss", 1, ['reason' => 'unsupported_mode']);

            return;
        }

        $modeInt = Beatmap::modeInt($this->getMode());
        $stats = BeatmapModeStats::where([
            'beatmap_id' => $this->beatmap_id,
            'mode' => $modeInt,
        ])->first();

        if ($stats === null) {
            Datadog::increment("{$ddPrefix}.miss", 1, ['reason' => 'missing_stats']);

            return;
        }

        if ($stats->unique_users < config('osu.scores.rank_cache.min_users')) {
            Datadog::increment("{$ddPrefix}.miss", 1, ['reason' => 'not_enough_unique_users']);

            return;
        }

        try {
            $response = (new Client(['base_uri' => $server]))
                ->request('GET', 'rankLookup', [
                    'connect_timeout' => 1,
                    'timeout' => config('osu.scores.rank_cache.timeout'),

                    'query' => [
                        'beatmapId' => $this->beatmap_id,
                        'rulesetId' => $modeInt,
                        'score' => $this->score,
                    ],
                ])
                ->getBody()
                ->getContents();
        } catch (Exception $e) {
            log_error($e);
            Datadog::increment("{$ddPrefix}.miss", 1, ['reason' => 'fetch_failure']);

            return;
        }

        Datadog::increment("{$ddPrefix}.hit", 1);

        return 1 + $response;
    }

    public function macroUserBest()
    {
        return function ($query, $limit, $offset = 0, $includes = []) {
            $baseResult = (clone $query)
                ->with($includes)
                ->limit(($limit + $offset) * 2)
                ->get();

            $results = [];
            $beatmaps = [];

            foreach ($baseResult as $entry) {
                if (count($results) >= $limit + $offset) {
                    break;
                }

                if (isset($beatmaps[$entry->beatmap_id])) {
                    continue;
                }

                $beatmaps[$entry->beatmap_id] = true;
                $results[] = $entry;
            }

            return array_slice($results, $offset);
        };
    }

    /**
     * Gets up-to-date User score rank counts.
     *
     * This can be relatively slow for large numbers of scores, so
     *  prefer getting the cached counts from one of the UserStatistics objects instead.
     *
     * @return array [user_id => [rank => count]]
     */
    public function macroAccurateRankCounts()
    {
        return function ($query) {
            $newQuery = clone $query;
            // FIXME: mysql 5.6 compat
            $newQuery->getQuery()->orders = null;

            $scores = $newQuery
                ->select(['user_id', 'beatmap_id', 'score', 'rank'])
                ->get();

            $result = [];
            $counted = [];

            foreach ($scores as $score) {
                if (!isset($result[$score->user_id])) {
                    $result[$score->user_id] = [];
                }

                $countedKey = "{$score->user_id}:{$score->beatmap_id}";

                if (isset($counted[$countedKey])) {
                    $countedScore = $counted[$countedKey];
                    if ($countedScore->score < $score->score) {
                        $result[$score->user_id][$countedScore->rank] -= 1;
                        $counted[$countedKey] = $score;
                    } else {
                        continue;
                    }
                }
                $counted[$countedKey] = $score;

                if (!isset($result[$score->user_id][$score->rank])) {
                    $result[$score->user_id][$score->rank] = 0;
                }

                $result[$score->user_id][$score->rank] += 1;
            }

            return $result;
        };
    }

    public function scopeDefault($query)
    {
        return $query
            ->whereHas('beatmap')
            ->orderBy('score', 'DESC')
            ->orderBy('score_id', 'ASC');
    }

    public function scopeVisibleUsers($query)
    {
        return $query->where(['hidden' => false]);
    }

    public function scopeWithType($query, $type, $options)
    {
        switch ($type) {
            case 'country':
                $countryAcronym = $options['countryAcronym'] ?? $options['user']->country_acronym ?? Country::UNKNOWN;

                return $query->fromCountry($countryAcronym);
            case 'friend':
                return $query->friendsOf($options['user']);
        }
    }

    public function scopeFromCountry($query, $countryAcronym)
    {
        return $query->where('country_acronym', $countryAcronym);
    }

    public function scopeFriendsOf($query, $user)
    {
        $userIds = $user->friends()->allRelatedIds();
        $userIds[] = $user->getKey();

        return $query->whereIn('user_id', $userIds);
    }

    /**
     * Override parent scope with a noop as only passed scores go in here.
     * And the `pass` column doesn't exist.
     */
    public function scopeIncludeFails($query, bool $include)
    {
        return $query;
    }

    public function getPassAttribute(): bool
    {
        return true;
    }

    public function isPersonalBest(): bool
    {
        return !static
            ::where([
                'user_id' => $this->user_id,
                'beatmap_id' => $this->beatmap_id,
            ])->where(function ($q) {
                return $q
                    ->where('score', '>', $this->score)
                    ->orWhere(function ($qq) {
                        return $qq->where('score', $this->score)
                            ->where($this->getKeyName(), '<', $this->getKey());
                    });
            })->exists();
    }

    public function replayViewCount()
    {
        $class = ReplayViewCount::class.'\\'.get_class_basename(static::class);

        return $this->hasOne($class, 'score_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * This doesn't delete the score in elasticsearch.
     */
    public function delete()
    {
        $result = $this->getConnection()->transaction(function () {
            $statsColumn = static::RANK_TO_STATS_COLUMN_MAPPING[$this->rank] ?? null;

            if ($statsColumn !== null && $this->isPersonalBest()) {
                $userStats = $this->user?->statistics($this->gameModeString());

                if ($userStats !== null) {
                    $userStats->decrement($statsColumn);

                    $nextBest = static::where([
                        'beatmap_id' => $this->beatmap_id,
                        'user_id' => $this->user_id,
                    ])->where($this->getKeyName(), '<>', $this->getKey())
                    ->orderBy('score', 'DESC')
                    ->orderBy($this->getKeyName(), 'ASC')
                    ->first();

                    if ($nextBest !== null) {
                        $nextBestStatsColumn = static::RANK_TO_STATS_COLUMN_MAPPING[$nextBest->rank] ?? null;

                        if ($nextBestStatsColumn !== null) {
                            $userStats->increment($nextBestStatsColumn);
                        }
                    }
                }
            }

            $this->replayViewCount?->delete();

            return parent::delete();
        });

        optional($this->replayFile())->delete();

        return $result;
    }

    public function getBestAttribute()
    {
        return $this;
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'mode' => Beatmap::modeInt($this->getMode()),
            'reason' => 'Cheating',
            'score_id' => $this->getKey(),
            'user_id' => $this->user_id,
        ];
    }
}
