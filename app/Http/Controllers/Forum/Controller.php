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
            $forumId = $object->topic()->withTrashed()->value('forum_id');
            $topicId = $object->topic_id;
        }

        $this->log([
            'log_type' => Log::LOG_FORUM_MOD,
            'log_operation' => $operation,
            'log_data' => $data,

            'topic_id' => $topicId ?? null,
            'forum_id' => $forumId ?? null,
        ]);
    }
}
