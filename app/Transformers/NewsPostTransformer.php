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

use App\Models\NewsPost;
use League\Fractal;

class NewsPostTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'content',
        'navigation',
        'preview',
    ];

    public function transform(NewsPost $post)
    {
        return [
            'id' => $post->id,

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
        return $this->primitive($post->bodyHtml(), function ($html) {
            return $html;
        });
    }

    public function includeNavigation(NewsPost $post)
    {
        return $this->item($post, function ($post) {
            $ret = [];
            if ($post->newer() !== null) {
                $ret['newer'] = json_item($post->newer(), 'NewsPost');
            }
            if ($post->older() !== null) {
                $ret['older'] = json_item($post->older(), 'NewsPost');
            }

            return $ret;
        });
    }

    public function includePreview(NewsPost $post)
    {
        return $this->primitive($post->previewText(), function ($text) {
            return $text;
        });
    }
}
