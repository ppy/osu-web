<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score\Best;

use App\Libraries\ReplayFile;
use App\Models\Beatmap;
use App\Models\ReplayViewCount;
use App\Models\Reportable;
use App\Models\Score\Model as BaseModel;
use App\Models\User;
use DB;

/**
 * @property User $user
 */
abstract class Model extends BaseModel
{
    use Reportable;

    public $position = null;
    public $weight = null;
    public $macros = [
        'accurateRankCounts',
        'forListing',
        'userBest',
    ];

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

    public function weightedPp()
    {
        return $this->weight * $this->pp;
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

        $query = static
            ::where('beatmap_id', '=', $this->beatmap_id)
            ->cursorWhere([
                ['column' => 'score', 'order' => 'ASC', 'value' => $this->score],
                ['column' => 'score_id', 'order' => 'DESC', 'value' => $this->getKey()],
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
                $countryAcronym = $options['countryAcronym'] ?? $options['user']->country_acronym;

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

    public function replayViewCount()
    {
        $class = ReplayViewCount::class.'\\'.get_class_basename(static::class);

        return $this->hasOne($class, 'score_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delete()
    {
        $result = $this->getConnection()->transaction(function () {
            $stats = optional($this->user)->statistics($this->gameModeString());

            if ($stats !== null) {
                $statsColumn = static::RANK_TO_STATS_COLUMN_MAPPING[$this->rank] ?? null;

                if ($statsColumn !== null) {
                    $stats->decrement($statsColumn);
                }
            }

            optional($this->replayViewCount)->delete();

            return parent::delete();
        });

        optional($this->replayFile())->delete();

        return $result;
    }

    public function getBestIdAttribute()
    {
        return $this->getKey();
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
