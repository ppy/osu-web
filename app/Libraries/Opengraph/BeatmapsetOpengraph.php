<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Beatmapset;

class BeatmapsetOpengraph implements OpengraphInterface
{
    public function __construct(private Beatmapset $beatmapset)
    {
    }

    public function get(): array
    {
        $section = osu_trans('layout.menu.beatmaps._');
        $title = "{$this->beatmapset->artist} - {$this->beatmapset->title}"; // opengraph header always intended for guest.

        return [
            'description' => "osu! » {$section} » {$title}",
            'image' => $this->beatmapset->coverURL('card'),
            'title' => $title,
        ];
    }
}
