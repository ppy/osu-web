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

namespace App\Transformers;

use App\Models\BeatmapDiscussion;
use Auth;
use League\Fractal;

class BeatmapDiscussionTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
        'posts',
        'current_user_attributes',
        'starting_post',
        'votes',
    ];

    public function transform(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion)) {
            return [];
        }

        return [
            'id' => $discussion->id,
            'beatmapset_id' => $discussion->beatmapset_id,
            'beatmap_id' => $discussion->beatmap_id,
            'user_id' => $discussion->user_id,
            'deleted_by_id' => $discussion->deleted_by_id,
            'message_type' => $discussion->message_type,
            'parent_id' => $discussion->parent_id,
            'timestamp' => $discussion->timestamp,
            'resolved' => $discussion->resolved,
            'can_be_resolved' => $discussion->canBeResolved(),
            'can_grant_kudosu' => $discussion->canGrantKudosu(),
            'created_at' => json_time($discussion->created_at),
            'updated_at' => json_time($discussion->updated_at),
            'deleted_at' => json_time($discussion->deleted_at),
            'last_post_at' => json_time($discussion->last_post_at),

            'kudosu_denied' => $discussion->kudosu_denied,
        ];
    }

    public function includeStartingPost(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion)) {
            return;
        }

        return $this->item(
            $discussion->startingPost,
            new BeatmapDiscussionPostTransformer()
        );
    }

    public function includePosts(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion)) {
            return;
        }

        return $this->collection(
            $discussion->beatmapDiscussionPosts,
            new BeatmapDiscussionPostTransformer()
        );
    }

    public function includeVotes(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion)) {
            return;
        }

        return $this->primitive($discussion->votesSummary());
    }

    public function includeBeatmap(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion) || $discussion->beatmap_id === null) {
            return;
        }

        return $this->item(
            $discussion->beatmap,
            new BeatmapCompactTransformer()
        );
    }

    public function includeBeatmapset(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion)) {
            return;
        }

        return $this->item(
            $discussion->beatmapset,
            new BeatmapsetCompactTransformer()
        );
    }

    public function includeCurrentUserAttributes(BeatmapDiscussion $discussion)
    {
        if (!$this->isVisible($discussion)) {
            return;
        }

        $currentUser = Auth::user();

        if ($currentUser === null) {
            return;
        }

        $score = 0;

        // This assumes beatmapDiscussionVotes are already preloaded and
        // thus will save one query.
        foreach ($discussion->beatmapDiscussionVotes as $vote) {
            if ($vote->user_id === $currentUser->user_id) {
                $score = $vote->score;
                break;
            }
        }

        $ret = [
            'vote_score' => $score,
            'can_moderate_kudosu' => priv_check_user($currentUser, 'BeatmapDiscussionAllowOrDenyKudosu', $discussion)->can(),
            'can_resolve' => priv_check_user($currentUser, 'BeatmapDiscussionResolve', $discussion)->can(),
            'can_reopen' => priv_check_user($currentUser, 'BeatmapDiscussionReopen', $discussion)->can(),
            'can_destroy' => priv_check_user($currentUser, 'BeatmapDiscussionDestroy', $discussion)->can(),
        ];

        return $this->item($discussion, function () use ($ret) {
            return $ret;
        });
    }

    public function isVisible($discussion)
    {
        return priv_check('BeatmapDiscussionShow', $discussion)->can();
    }
}
