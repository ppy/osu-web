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

namespace App\Models;

use Carbon\Carbon;

/**
 * @property BeatmapDiscussion $beatmapDiscussion
 * @property int $beatmap_discussion_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $score
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 */
class BeatmapDiscussionVote extends Model
{
    protected $touches = ['beatmapDiscussion'];

    public static function recentlyReceivedByUser($userId, $timeframeMonths = 3)
    {
        return static::where('beatmap_discussion_votes.created_at', '>', Carbon::now()->subMonth($timeframeMonths))
            ->join('beatmap_discussions', 'beatmap_discussion_votes.beatmap_discussion_id', 'beatmap_discussions.id')
            ->select('beatmap_discussion_votes.user_id')
            ->selectRaw('sum(beatmap_discussion_votes.score) as score')
            ->selectRaw('count(beatmap_discussion_votes.score) as count')
            ->where('beatmap_discussions.user_id', $userId)
            ->where('beatmap_discussions.updated_at', '>', Carbon::now()->subMonth($timeframeMonths))
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            })
            ->groupBy('beatmap_discussion_votes.user_id')
            ->orderByDesc('count')
            ->get();
    }

    public static function recentlyGivenByUser($userId, $timeframeMonths = 3)
    {
        return static::where('beatmap_discussion_votes.created_at', '>', Carbon::now()->subMonth($timeframeMonths))
            ->join('beatmap_discussions', 'beatmap_discussion_votes.beatmap_discussion_id', 'beatmap_discussions.id')
            ->select('beatmap_discussions.user_id')
            ->selectRaw('sum(beatmap_discussion_votes.score) as score')
            ->selectRaw('count(beatmap_discussion_votes.score) as count')
            ->where('beatmap_discussion_votes.user_id', $userId)
            ->where('beatmap_discussions.updated_at', '>', Carbon::now()->subMonth($timeframeMonths))
            ->whereHas('beatmapDiscussion.user', function ($userQuery) {
                $userQuery->default();
            })
            ->groupBy('beatmap_discussions.user_id')
            ->orderByDesc('count')
            ->get();
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
