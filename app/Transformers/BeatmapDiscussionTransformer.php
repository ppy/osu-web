<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapDiscussion;

class BeatmapDiscussionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
        'posts',
        'current_user_attributes',
        'starting_post',
        'votes',
    ];

    protected $requiredPermission = 'BeatmapDiscussionShow';

    public function transform(BeatmapDiscussion $discussion)
    {
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
        if ($discussion->startingPost === null) {
            return;
        }

        return $this->item(
            $discussion->startingPost,
            new BeatmapDiscussionPostTransformer()
        );
    }

    public function includePosts(BeatmapDiscussion $discussion)
    {
        return $this->collection(
            $discussion->beatmapDiscussionPosts,
            new BeatmapDiscussionPostTransformer()
        );
    }

    public function includeVotes(BeatmapDiscussion $discussion)
    {
        return $this->primitive($discussion->votesSummary());
    }

    public function includeBeatmap(BeatmapDiscussion $discussion)
    {
        if ($discussion->beatmap_id === null) {
            return;
        }

        return $this->item(
            $discussion->beatmap,
            new BeatmapCompactTransformer()
        );
    }

    public function includeBeatmapset(BeatmapDiscussion $discussion)
    {
        return $this->item(
            $discussion->beatmapset,
            new BeatmapsetCompactTransformer()
        );
    }

    public function includeCurrentUserAttributes(BeatmapDiscussion $discussion)
    {
        $currentUser = auth()->user();

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
}
