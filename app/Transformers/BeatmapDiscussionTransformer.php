<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
        'beatmap_discussion_posts',
        'current_user_attributes',
    ];

    public function transform(BeatmapDiscussion $discussion)
    {
        return [
            'id' => $discussion->id,
            'beatmapset_discussion_id' => $discussion->beatmapset_discussion_id,
            'beatmap_id' => $discussion->beatmap_id,
            'user_id' => $discussion->user_id,
            'message_type' => $discussion->message_type,
            'timestamp' => $discussion->timestamp,
            'resolved' => $discussion->resolved,
            'created_at' => json_time($discussion->created_at),
            'updated_at' => json_time($discussion->updated_at),
            'votes' => $discussion->votesSummary(),
            'duration' => $discussion->total_length,
        ];
    }

    public function includeBeatmapDiscussionPosts(BeatmapDiscussion $discussion)
    {
        return $this->collection(
            $discussion->beatmapDiscussionPosts,
            new BeatmapDiscussionPostTransformer()
        );
    }

    public function includeCurrentUserAttributes(BeatmapDiscussion $discussion)
    {
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

        return $this->item($discussion, function ($discussion) use ($score) {
            return ['vote_score' => $score];
        });
    }
}
