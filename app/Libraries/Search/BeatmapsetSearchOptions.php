<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

class BeatmapsetSearchOptions
{
    public ?array $accuracy = null;
    public ?array $ar = null;
    public ?string $artist = null;
    public ?array $bpm = null;
    public ?array $countNormal = null;
    public ?array $countSlider = null;
    public ?array $created = null;
    public ?string $creator = null;
    public ?array $cs = null;
    public ?string $difficulty = null;
    public ?array $difficultyRating = null;
    public ?array $divisor = null;
    public ?array $drain = null;
    public ?array $favouriteCount = null;
    public ?int $featuredArtist = null;
    public ?array $keys = null;
    public ?array $ranked = null;
    public ?string $source = null;
    public ?array $statusRange = null;
    public ?array $tags = null;
    public ?string $title = null;
    public ?array $totalLength = null;
    public ?string $updated = null;

    // mostly for testing for array comparision
    public function toArray(): array
    {
        return array_filter((array) $this, fn ($value) => $value !== null);
    }
}
