<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\Topic;
use App\Transformers\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->getKey(),

            'forum_id' => $topic->forum_id,
            'user_id' => $topic->topic_poster,

            'is_locked' => $topic->isLocked(),
            'title' => $topic->topic_title,
            'type' => $topic->typeStr($topic->topic_type),

            'first_post_id' => $topic->topic_first_post_id,
            'last_post_id' => $topic->topic_last_post_id,

            'created_at' => $topic->topic_time,
            'deleted_at' => $topic->deleted_at,
            'updated_at' => $topic->topic_last_post_time,
        ];
    }
}
