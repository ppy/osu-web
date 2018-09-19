<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Models;

use Carbon\Carbon;

class BeatmapDiscussionVote extends Model
{
    public static function recentlyReceivedByUser($userId, $timeframeMonths = 3)
    {
        $query = static::with('user')->where('created_at', '>', Carbon::now()->subMonth($timeframeMonths));
        $query->whereIn('beatmap_discussion_id', BeatmapDiscussion::where('user_id', '=', $userId)->select('id'))
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            });

        $result = $query->get()
            ->groupBy('user_id')
            ->sortByDesc(function ($obj, $key) {
                return $obj->sum('score');
            });

        return $result;
    }

    public static function recentlyGivenByUser($userId, $timeframeMonths = 3)
    {
        $query = static::with(['beatmapDiscussion', 'beatmapDiscussion.user'])->where('created_at', '>', Carbon::now()->subMonth($timeframeMonths));
        $query->where('user_id', $userId)->whereHas('user', function ($userQuery) {
            $userQuery->default();
        });

        $result = $query->get()
            ->groupBy('beatmapDiscussion.user_id')
            ->sortByDesc(function ($obj, $key) {
                return $obj->sum('score');
            });

        return $result;
    }

    public static function search($rawParams = [])
    {
        $params = [
            'limit' => clamp(get_int($rawParams['limit'] ?? null) ?? 20, 5, 50),
            'page' => max(get_int($rawParams['page'] ?? null) ?? 1, 1),
        ];

        $query = static::limit($params['limit'])->offset(($params['page'] - 1) * $params['limit']);

        if (isset($rawParams['user'])) {
            $params['user'] = $rawParams['user'];
            $user = User::lookup($params['user']);

            if ($user === null) {
                $query->none();
            } else {
                $query->where('user_id', $user->getKey());
            }
        }

        if (isset($rawParams['receiver'])) {
            $params['receiver'] = $rawParams['receiver'];
            $user = User::lookup($params['receiver']);

            if ($user === null) {
                $query->none();
            } else {
                $query->whereIn('beatmap_discussion_id', BeatmapDiscussion::where('user_id', '=', $user->getKey())->select('id'));
            }
        }

        if (isset($rawParams['sort'])) {
            $sort = explode('-', strtolower($rawParams['sort']));

            if (in_array($sort[0] ?? null, ['id'], true)) {
                $sortField = $sort[0];
            }

            if (in_array($sort[1] ?? null, ['asc', 'desc'], true)) {
                $sortOrder = $sort[1];
            }
        }

        $sortField ?? ($sortField = 'id');
        $sortOrder ?? ($sortOrder = 'desc');

        $params['sort'] = "{$sortField}-{$sortOrder}";
        $query->orderBy($sortField, $sortOrder);

        if (isset($rawParams['score'])) {
            $params['score'] = get_int($rawParams['score']);
            if ($params['score'] !== null) {
                $query->where('score', '=', $params['score']);
            }
        }

        if (!($rawParams['is_moderator'] ?? false)) {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->default();
            });
        }

        return ['query' => $query, 'params' => $params];
    }

    public function beatmapDiscussion()
    {
        return $this->belongsTo(BeatmapDiscussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setScoreAttribute($value)
    {
        if ($value > 0) {
            $value = 1;
        } elseif ($value < 0) {
            $value = -1;
        } else {
            $value = 0;
        }

        $this->attributes['score'] = $value;
    }

    public function forEvent()
    {
        return [
            'user_id' => $this->user_id,
            'score' => $this->score,
        ];
    }
}
