<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionVote;
use App\Models\User;
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
            'cursor' => $this->getCursor(),
            'discussions' => json_collection($this->getDiscussions(), new BeatmapDiscussionTransformer()),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer(), ['groups']),
            'votes' => json_collection($this->getVotes(), new BeatmapDiscussionVoteTransformer()),
        ];
    }

    private function getDiscussions()
    {
        return BeatmapDiscussion::whereIn('id', $this->getVotes()->pluck('beatmap_discussion_id')->unique()->values())->get();
    }

    private function getUsers()
    {
        return $this->memoize(__FUNCTION__, function () {
            $userIds = $this->getVotes()->pluck('user_id')->unique()->values();

            $users = User::whereIn('user_id', $userIds)->with('userGroups');

            if (!$this->isModerator) {
                $users->default();
            }

            return $users->get();
        });
    }

    private function getVotes()
    {
        return $this->memoize(__FUNCTION__, function () {
            $this->search = BeatmapDiscussionVote::search($this->params);

            $query = $this->search['query']->with([
                'user',
                'beatmapDiscussion',
                'beatmapDiscussion.user',
                'beatmapDiscussion.beatmapset',
                'beatmapDiscussion.startingPost',
            ]);

            $this->paginator = new LengthAwarePaginator(
                $query->get(),
                $this->search['params']['limit'],
                $this->search['params']['page'],
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'query' => $this->search['params'],
                ]
            );

            return $this->paginator->getCollection();
        });
    }
}
