<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Comment;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user',
    ];

    protected $defaultIncludes = [
        'deleted_by_id',
        'message',
        'message_html',
    ];

    protected $permissions = [
        'deleted_by_id' => 'CommentModerate',
        'message' => 'CommentShow',
        'message_html' => 'CommentShow',
    ];

    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'user_id' => $comment->user_id,
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

    public function includeDeletedById(Comment $comment)
    {
        return $this->primitive($comment->deleted_by_id);
    }

    public function includeMessage(Comment $comment)
    {
        return $this->primitive($comment->message);
    }

    public function includeMessageHtml(Comment $comment)
    {
        return $this->primitive(markdown($comment->message, 'comment'));
    }

    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserCompactTransformer());
    }
}
