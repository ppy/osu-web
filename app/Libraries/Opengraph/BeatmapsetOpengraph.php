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
        $title = "{$this->beatmapset->artist} - {$this->beatmapset->title}"; // opengraph header always intended for guest.

        return [
            'description' => $this->description(),
            'image' => $this->beatmapset->coverURL('list'),
            'title' => $title,
        ];
    }

    private function description(): string
    {
        return implode(' | ', [
            osu_trans('beatmapsets.show.details.mapped_by', [
                'mapper' => $this->beatmapset->creator,
            ]),
            $this->statusText(),
            osu_trans_choice('beatmapsets.ogp.playcount', $this->beatmapset->play_count),
            osu_trans_choice('beatmapsets.ogp.favourites', $this->beatmapset->favourite_count),
        ]);
    }

    private function statusText(): string
    {
        if ($this->beatmapset->approved > 0) {
            $key = $this->beatmapset->status();
            $date = $this->beatmapset->approved_date;
        } else {
            $key = 'updated';
            $date = $this->beatmapset->last_update;
        }

        return osu_trans("beatmapsets.show.details_date.{$key}", [
            'timeago' => $date?->diffForHumans() ?? '',
        ]);
    }
}
