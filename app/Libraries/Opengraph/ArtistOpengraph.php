<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Artist;

class ArtistOpengraph implements OpengraphInterface
{
    public function __construct(private Artist $artist)
    {
    }

    public function get(): array
    {
        return [
            'description' => first_paragraph(markdown_plain($this->artist->description)),
            'image' => $this->artist->cover_url,
            'title' => $this->artist->name,
        ];
    }
}
