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

use App\Models\Beatmapset;
use App\Models\Build;
use App\Models\Comment;
use App\Models\NewsPost;
use League\Fractal;
use Markdown;

class CommentTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'commentable_meta',
        'editor',
        'user',
        'parent',
    ];

    public function transform(Comment $comment)
    {
        $message = priv_check('CommentUpdate', $comment)->can()
            ? $comment->message
            : null;

        $messageHtml = priv_check('CommentShow', $comment)->can()
            ? Markdown::convertToHtml($comment->message)
            : null;

        return [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'user_id' => $comment->user_id,
            'message' => $message,
            'message_html' => $messageHtml,
            'replies_count' => $comment->replies_count_cache,

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

    public function includeCommentableMeta(Comment $comment)
    {
        return $this->item($comment->commentable, function ($commentable) {
            // probably belongs somewhere else
            if ($commentable instanceof Beatmapset) {
                $titlePrefix = trans('comments.commentable_name.beatmapset');
                $title = $commentable->artist.' - '.$commentable->title;
                $url = route('beatmapsets.show', $commentable);
            } elseif ($commentable instanceof Build) {
                $titlePrefix = trans('comments.commentable_name.build');
                $title = $commentable->updateStream->display_name.' '.$commentable->displayVersion();
                $url = build_url($commentable);
            } elseif ($commentable instanceof NewsPost) {
                $titlePrefix = trans('comments.commentable_name.news_post');
                $title = $commentable->title();
                $url = route('news.show', $commentable->slug);
            } else {
                $title = trans('comments.commentable_name._deleted');
                $url = null;
            }

            return [
                'title' => isset($titlePrefix) ? "{$titlePrefix}: {$title}" : $title,
                'url' => $url,
            ];
        });
    }

    public function includeEditor(Comment $comment)
    {
        if ($comment->editor === null) {
            return;
        }

        return $this->item($comment->editor, new UserCompactTransformer);
    }

    public function includeParent(Comment $comment)
    {
        if ($comment->parent === null) {
            return;
        }

        return $this->item($comment->parent, new static);
    }

    public function includeUser(Comment $comment)
    {
        if ($comment->user === null) {
            return;
        }

        return $this->item($comment->user, new UserCompactTransformer);
    }
}
