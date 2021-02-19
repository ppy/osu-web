<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Libraries\BeatmapsetDiscussionReview;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\User;
use Illuminate\Support\Collection;

class BeatmapDiscussionsTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmaps',
        'included_discussions',
        'reviews_config',
        'users',
    ];

    public function transform(Collection $discussions)
    {
        return [
            'discussions' => json_collection($discussions, new BeatmapDiscussionTransformer(), ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes']),
        ];
    }

    public function includeBeatmaps(Collection $discussions)
    {
        $beatmapsetIds = $discussions->pluck('beatmapset_id')->unique()->values();
        $beatmaps = Beatmap::whereIn('beatmapset_id', $beatmapsetIds)->get();

        return $this->collection($beatmaps, new BeatmapTransformer());
    }

    public function includeIncludedDiscussions(Collection $discussions)
    {
        return $this->primitive(
            json_collection(
                $this->getRelatedDiscussions($discussions),
                new BeatmapDiscussionTransformer(),
                ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes']
            )
        );
    }

    public function includeReviewsConfig(Collection $discussions)
    {
        return $this->primitive(BeatmapsetDiscussionReview::config());
    }

    public function includeUsers(Collection $discussions)
    {
        $allDiscussions = $discussions->merge($this->getRelatedDiscussions($discussions));
        $userIds = $allDiscussions->pluck('user_id')->merge($allDiscussions->pluck('startingPost.last_editor_id'))->unique()->values();

        $users = User::whereIn('user_id', $userIds)->with('userGroups');

        // TODO: react side should be fixed to not die on missing user.
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

    private function getRelatedDiscussions($discussions)
    {
        $related = BeatmapDiscussion::whereIn('parent_id', $discussions->pluck('id'))
            ->with([
                'beatmap',
                'beatmapDiscussionVotes',
                'beatmapset',
                'startingPost',
            ]);

        // FIXME:  related queries having the same condition but having to handle separately is annoying,
        // maybe bundle that can handle the lookup as well is better?
        if ($this->isModerator()) {
            $related->visibleWithTrashed();
        } else {
            $related->visible();
        }


        return $related->get();
    }

    private function isModerator()
    {
        return priv_check('BeatmapDiscussionModerate')->can();
    }
}
