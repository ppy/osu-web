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

use App\Models\Comment;
use League\Fractal;

class CommentTransformer extends Fractal\TransformerAbstract
{
    public function transform(Comment $comment)
    {
        if (priv_check('CommentShow', $comment)->can()) {
            $message = $comment->message;
            $messageHtml = markdown($comment->message);
        }

        return [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'user_id' => $comment->user_id,
            'message' => $message ?? null,
            'message_html' => $messageHtml ?? null,
            'pinned' => $comment->pinned ?? false,
            'replies_count' => $comment->replies_count_cache ?? 0,
            'votes_count' => $comment->votes_count_cache ?? 0,

            'commentable_type' => $comment->commentable_type,
            'commentable_id' => $comment->commentable_id,

            'legacy_name' => $comment->legacyName(),

            'created_at' => json_time($comment->created_at),
            'updated_at' => json_time($comment->updated_at),

            'deleted_at' => json_time($comment->deleted_at),

            'edited_at' => json_time($comment->edited_at),
            'edited_by_id' => $comment->edited_by_id,
        ];
    }
}
