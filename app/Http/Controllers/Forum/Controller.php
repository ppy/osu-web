<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Log;

abstract class Controller extends BaseController
{
    public function logModerate($operation, $data, $object)
    {
        if ($object instanceof Forum) {
            $forumId = $object->getKey();
        } elseif ($object instanceof Topic) {
            $forumId = $object->forum_id;
            $topicId = $object->getKey();
        } elseif ($object instanceof Post) {
            $forumId = $object->forum_id;
            $postId = $object->getKey();
            $topicId = $object->topic_id;
        }

        $this->log([
            'log_type' => Log::LOG_FORUM_MOD,
            'log_operation' => $operation,
            'log_data' => $data,

            'forum_id' => $forumId ?? null,
            'post_id' => $postId ?? null,
            'topic_id' => $topicId ?? null,
        ]);
    }
}
