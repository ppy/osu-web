<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use Markdown;

class CommentTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'user',
        'editor',
    ];

    public function transform(Comment $comment)
    {
        $message = priv_check('CommentShow', $comment)->can()
            ? $comment->message
            : null;

        return [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'user_id' => $comment->user_id,
            'message' => $message,
            'message_html' => Markdown::convertToHtml($message),

            'commentable_type' => $comment->commentable_type,
            'commentable_id' => $comment->commentable_id,

            'legacy_username' => $comment->legacyUsername(),

            'created_at' => json_time($comment->created_at),
            'updated_at' => json_time($comment->updated_at),
            'deleted_at' => json_time($comment->deleted_at),
            'edited_at' => json_time($comment->edited_at),
        ];
    }

    public function includeEditor(Comment $comment)
    {
        if ($comment->editor === null) {
            return;
        }

        return $this->item($comment->editor, new UserCompactTransformer);
    }

    public function includeUser(Comment $comment)
    {
        if ($comment->user === null) {
            return;
        }

        return $this->item($comment->user, new UserCompactTransformer);
    }
}
