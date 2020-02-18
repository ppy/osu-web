<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Score\Best;

use App\Libraries\ModsHelper;
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
        $instance = new static;
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

            $baseResult = $newQuery->get();

            $result = [];
            $users = [];

            foreach ($baseResult as $entry) {
                if (isset($users[$entry->user_id])) {
                    continue;
                }

                if (count($result) >= $limit) {
                    break;
                }

                $users[$entry->user_id] = true;
                $result[] = $entry;
            }

            return $result;
        };
    }

    public function userRank($options)
    {
        return with_db_fallback('mysql-readonly', function ($connection) use ($options) {
            $alwaysAccurate = false;

            $query = static::on($connection)
                ->where('beatmap_id', '=', $this->beatmap_id)
                ->where(function ($query) {
                    $query
                        ->where('score', '>', $this->score)
                        ->orWhere(function ($query2) {
                            $query2
                                ->where('score', '=', $this->score)
                                ->where('score_id', '<', $this->getKey());
                        });
                });

            if (isset($options['type'])) {
                $query->withType($options['type'], ['user' => $this->user]);

                if ($options['type'] === 'country') {
                    $alwaysAccurate = true;
                }
            }

            if (isset($options['mods'])) {
                $query->withMods($options['mods']);
            }

            $countQuery = DB::raw('DISTINCT user_id');

            if ($alwaysAccurate) {
                return 1 + $query->default()->count($countQuery);
            }

            $rank = 1 + $query->count($countQuery);

            if ($rank < config('osu.beatmaps.max-scores') * 3) {
                return 1 + $query->default()->count($countQuery);
            } else {
                return $rank;
            }
        });
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
            ->where(['hidden' => false]);
    }

    public function scopeDefaultListing($query)
    {
        return $query
            ->default()
            ->orderBy('score', 'DESC')
            ->orderBy('score_id', 'ASC')
            ->limit(config('osu.beatmaps.max-scores'));
    }

    public function scopeWithMods($query, $modsArray)
    {
        return $query->where(function ($q) use ($modsArray) {
            if (in_array('NM', $modsArray, true)) {
                $q->orWhere('enabled_mods', 0);
            }

            $bitset = ModsHelper::toBitset($modsArray);
            if ($bitset > 0) {
                $q->orWhere('enabled_mods', $bitset);
            }
        });
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
