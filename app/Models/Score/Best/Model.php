<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score\Best;

use App\Libraries\ReplayFile;
use App\Libraries\Score\UserRankCache;
use App\Models\Beatmap;
use App\Models\Country;
use App\Models\ReplayViewCount;
use App\Models\Score\Model as BaseModel;
use App\Models\Traits;
use App\Models\User;
use DB;

/**
 * @property User $user
 */
abstract class Model extends BaseModel implements Traits\ReportableInterface
{
    use Traits\Reportable, Traits\WithDbCursorHelper, Traits\WithWeightedPp;

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
        $modeId = Beatmap::MODES[$instance->getMode()];

        $instance->getConnection()->insert(
            "INSERT INTO score_process_queue (score_id, mode, status) SELECT score_id, {$modeId}, 1 FROM {$table} WHERE user_id = {$user->getKey()}"
        );
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'count100',
            'count300',
            'count50',
            'countgeki',
            'countkatu',
            'countmiss',
            'country_acronym',
            'maxcombo',
            'pp',
            'rank',
            'score',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'hidden',
            'perfect',
            'replay' => (bool) $this->getRawAttribute($key),

            'date' => $this->getTimeFast($key),

            'date_json' => $this->getJsonTimeFast($key),

            'best' => $this,
            'data' => $this->getData(),
            'enabled_mods' => $this->getEnabledModsAttribute($this->getRawAttribute('enabled_mods')),
            'pass' => true,

            'beatmap',
            'replayViewCount',
            'reportedIn',
            'user' => $this->getRelationValue($key),
        };
    }

    public function replayFile(): ?ReplayFile
    {
        if ($this->replay) {
            return new ReplayFile($this);
        }

        return null;
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

    public function url(): string
    {
        return route('scores.show-legacy', ['mode' => $this->getMode(), 'score' => $this->getKey()]);
    }

    public function userRank($options)
    {
        // laravel model has a $hidden property
        if ($this->getAttribute('hidden')) {
            return;
        }

        if ($options['cached'] ?? true) {
            $rank = UserRankCache::fetch(
                $options,
                $this->beatmap_id,
                Beatmap::modeInt($this->getMode()),
                $this->score,
            );

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
            $scores = (clone $query)
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

    public function isPersonalBest(): bool
    {
        return $this->getKey() === (static
            ::where([
                'user_id' => $this->user_id,
                'beatmap_id' => $this->beatmap_id,
            ])->default()
            ->limit(1)
            ->pluck('score_id')
            ->first() ?? $this->getKey());
    }

    public function replayViewCount()
    {
        $class = ReplayViewCount::class.'\\'.get_class_basename(static::class);

        return $this->hasOne($class, 'score_id');
    }

    public function trashed()
    {
        return $this->getAttribute('hidden');
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
                $userStats = $this->user?->statistics($this->getMode());

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

        $this->replayFile()?->delete();

        return $result;
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
