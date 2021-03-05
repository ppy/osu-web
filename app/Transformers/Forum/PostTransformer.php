<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\Post;
use App\Transformers\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'body',
    ];

    public function transform(Post $post)
    {
        return [
            'created_at' => json_time($post->post_time),
            'deleted_at' => json_time($post->deleted_at),
            'edited_at' => json_time($post->post_edit_time),
            'edited_by_id' => $post->post_edit_user,
            'forum_id' => $post->forum_id,
            'id' => $post->getKey(),
            'topic_id' => $post->topic_id,
            'user_id' => $post->poster_id,
        ];
    }

    public function includeBody(Post $post)
    {
        return $this->primitive([
            'html' => $post->bodyHTML(),
            'raw' => $post->bodyRaw,
        ]);
    }
}
