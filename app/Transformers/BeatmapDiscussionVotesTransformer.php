<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapDiscussion;
use App\Models\User;
use Illuminate\Support\Collection;

class BeatmapDiscussionVotesTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'discussions',
        'users',
    ];

    public function transform(Collection $votes)
    {
        return [
            'votes' => json_collection($votes, new BeatmapDiscussionVoteTransformer()),
        ];
    }

    public function includeDiscussions(Collection $votes)
    {
        $discussions = BeatmapDiscussion::whereIn('id', $votes->pluck('beatmap_discussion_id')->unique()->values());

        if ($this->isModerator()) {
            $discussions->visibleWithTrashed();
        } else {
            $discussions->visible();
        }

        return $this->primitive(
            json_collection(
                $discussions->get(),
                new BeatmapDiscussionTransformer()
            )
        );
    }

    public function includeUsers(Collection $votes)
    {
        $userIds = $votes->pluck('user_id')->unique()->values();

        $users = User::whereIn('user_id', $userIds)->with('userGroups');

        if (!$this->isModerator()) {
            $users->default();
        }

        return $this->primitive(
            json_collection(
                $users->get(),
                new UserCompactTransformer(),
                ['groups']
            )
        );
    }

    private function isModerator()
    {
        return priv_check('BeatmapDiscussionModerate')->can();
    }
}
