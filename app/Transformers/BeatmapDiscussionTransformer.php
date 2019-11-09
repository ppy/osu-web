<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\BeatmapDiscussion;
use Auth;
use League\Fractal;

class BeatmapDiscussionTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
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
