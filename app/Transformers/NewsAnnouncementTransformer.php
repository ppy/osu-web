<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\NewsAnnouncement;

class NewsAnnouncementTransformer extends TransformerAbstract
{
    public function transform(NewsAnnouncement $newsAnnouncement): array
    {
        return [
            'content' => $newsAnnouncement->content_markdown === null ? null : [
                'html' => $newsAnnouncement->content_html,
                'markdown' => $newsAnnouncement->content_markdown,
            ],
            'ended_at' => $newsAnnouncement->ended_at_json,
            'id' => $newsAnnouncement->getKey(),
            'image_url' => $newsAnnouncement->image_url,
            'order' => $newsAnnouncement->order,
            'started_at' => $newsAnnouncement->started_at_json,
            'url' => $newsAnnouncement->url,
        ];
    }
}
