<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

class DeletedBeatmapset extends Beatmapset
{
    public int $beatmapset_id = 0;
    public $title = '[deleted beatmap]';

    public function getKey(): int
    {
        return $this->beatmapset_id;
    }

    public function trashed()
    {
        return true;
    }
}
