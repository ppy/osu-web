<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
