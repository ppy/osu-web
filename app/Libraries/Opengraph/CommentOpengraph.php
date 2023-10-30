<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Comment;

class CommentOpengraph
{
    public function __construct(private Comment $comment)
    {
    }

    public function get(): array
    {
        $user = $this->comment->user;

        return priv_check_user(null, 'CommentShow', $this->comment)->can()
            ? [
                'description' => blade_safe(html_excerpt($this->comment->message_html, 100)),
                'image' => $user->user_avatar,
                'title' => osu_trans('comments.ogp.title', ['user' => $user->username]),
            ] : [];
    }
}
