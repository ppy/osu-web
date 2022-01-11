<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BeatmapDiscussionVote;
use App\Traits\Memoizes;
use App\Transformers\BeatmapDiscussionTransformer;
use App\Transformers\BeatmapDiscussionVoteTransformer;
use App\Transformers\UserCompactTransformer;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatmapsetDiscussionVotesBundle extends BeatmapsetDiscussionsBundleBase
{
    use Memoizes;

    public function getData()
    {
        return $this->getVotes();
    }

    public function toArray()
    {
        return [
            'discussions' => json_collection($this->getDiscussions(), new BeatmapDiscussionTransformer()),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer(), ['groups']),
            'votes' => json_collection($this->getVotes(), new BeatmapDiscussionVoteTransformer()),
        ];
    }

    private function getDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->getVotes()->pluck('beatmapDiscussion')->uniqueStrict()->filter()->values();
        });
    }

    private function getUsers()
    {
        return $this->memoize(__FUNCTION__, function () {
            $users = $this->getVotes()
                ->pluck('user')
                ->merge($this->getDiscussions()->pluck('user'))
                ->uniqueStrict('user_id')
                ->values();

            // TODO: move/add output filtering to transformer;
            // there's other issues with discussions that need handling first for it
            // to work, though.
            if (!$this->isModerator) {
                $users = $users->filter(function ($user) {
                    return !$user->isRestricted();
                });
            }

            return $users;
        });
    }

    private function getVotes()
    {
        return $this->memoize(__FUNCTION__, function () {
            ['query' => $query, 'params' => $params] = BeatmapDiscussionVote::search($this->params);

            $votes = $query->with([
                'user.userGroups',
                'beatmapDiscussion',
                'beatmapDiscussion.user.userGroups',
                'beatmapDiscussion.beatmapset',
                'beatmapDiscussion.startingPost',
            ])->get();

            $this->paginator = new LengthAwarePaginator(
                $votes,
                $query->realCount(),
                $params['limit'],
                $params['page'],
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'query' => $params,
                ]
            );

            return $this->paginator->getCollection();
        });
    }
}
