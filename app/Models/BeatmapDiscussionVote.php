<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $pagination = pagination(cursor_from_params($rawParams) ?? $rawParams);

        $params = [
            'limit' => $pagination['limit'],
            'page' => $pagination['page'],
        ];

        $query = static::limit($params['limit'])->offset($pagination['offset']);
        $isModerator = $rawParams['is_moderator'] ?? false;

        if (isset($rawParams['user'])) {
            $params['user'] = $rawParams['user'];
            $findAll = $isModerator || (($rawParams['current_user_id'] ?? null) === $rawParams['user']);
            $user = User::lookup($params['user'], null, $findAll);

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
            $sort = explode('_', strtolower($rawParams['sort']));

            if (in_array($sort[0] ?? null, ['id'], true)) {
                $sortField = $sort[0];
            }

            if (in_array($sort[1] ?? null, ['asc', 'desc'], true)) {
                $sortOrder = $sort[1];
            }
        }

        $sortField ?? ($sortField = 'id');
        $sortOrder ?? ($sortOrder = 'desc');

        $params['sort'] = "{$sortField}_{$sortOrder}";
        $query->orderBy($sortField, $sortOrder);

        if (isset($rawParams['score'])) {
            $params['score'] = get_int($rawParams['score']);
            if ($params['score'] !== null) {
                $query->where('score', '=', $params['score']);
            }
        }

        $params['beatmapset_discussion_id'] = get_int($rawParams['beatmapset_discussion_id'] ?? null);
        if ($params['beatmapset_discussion_id'] !== null) {
            // column name is beatmap_ =)
            $query->where('beatmap_discussion_id', $params['beatmapset_discussion_id']);
        }

        // TODO: normalize with main beatmapset discussion behaviour (needs React-side fixing)
        if (!isset($user) && !$isModerator) {
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
