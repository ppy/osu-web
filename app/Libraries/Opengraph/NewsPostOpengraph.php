<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\NewsPost;

class NewsPostOpengraph
{
    public function __construct(private NewsPost $post)
    {
    }

    public function get(): array
    {
        return [
            'description' => $this->post->previewText(),
            'image' => $this->post->firstImage(true),
            'title' => $this->post->title(),
        ];
    }
}
