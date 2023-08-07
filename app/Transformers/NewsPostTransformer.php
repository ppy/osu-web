<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\NewsPost;

class NewsPostTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'content',
        'navigation',
        'preview',
    ];

    public function transform(NewsPost $post)
    {
        return [
            'id' => $post->id,

            'author' => $post->author(),
            'edit_url' => $post->editUrl(),
            'first_image' => $post->firstImage(),
            'published_at' => json_time($post->published_at),
            'updated_at' => json_time($post->updated_at),
            'slug' => $post->slug,
            'title' => $post->title(),
        ];
    }

    public function includeContent(NewsPost $post)
    {
        return $this->primitive($post->bodyHtml());
    }

    public function includeNavigation(NewsPost $post)
    {
        $ret = [];

        $newer = $post->newer();
        if ($newer !== null) {
            $ret['newer'] = json_item($newer, $this);
        }

        $older = $post->older();
        if ($older !== null) {
            $ret['older'] = json_item($older, $this);
        }

        return $this->primitive($ret);
    }

    public function includePreview(NewsPost $post)
    {
        return $this->primitive($post->previewText());
    }
}
