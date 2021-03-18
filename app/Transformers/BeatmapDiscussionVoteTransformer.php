<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapDiscussionVote;

class BeatmapDiscussionVoteTransformer extends TransformerAbstract
{
    public function transform(BeatmapDiscussionVote $vote)
    {
        return [
            'beatmapset_discussion_id' => $vote->beatmap_discussion_id,
            'created_at' => json_time($vote->created_at),
            'id' => $vote->getKey(),
            'score' => $vote->score,
            'updated_at' => json_time($vote->updated_at),
            'user_id' => $vote->user_id,
        ];
    }
}
