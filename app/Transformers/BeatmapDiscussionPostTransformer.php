<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapDiscussionPost;

class BeatmapDiscussionPostTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap_discussion',
    ];

    protected $requiredPermission = 'BeatmapDiscussionPostShow';

    public function transform(BeatmapDiscussionPost $post)
    {
        return [
            'beatmapset_discussion_id' => $post->beatmap_discussion_id,
            'created_at' => json_time($post->created_at),
            'deleted_at' => json_time($post->deleted_at),
            'deleted_by_id' => $post->deleted_by_id,
            'id' => $post->id,
            'last_editor_id' => $post->last_editor_id,
            'message' => $post->message,
            'system' => $post->system,
            'updated_at' => json_time($post->updated_at),
            'user_id' => $post->user_id,
        ];
    }

    public function includeBeatmapDiscussion(BeatmapDiscussionPost $post)
    {
        return $this->item(
            $post->beatmapDiscussion,
            new BeatmapDiscussionTransformer()
        );
    }
}
