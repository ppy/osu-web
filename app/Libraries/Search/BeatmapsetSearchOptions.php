<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

class BeatmapsetSearchOptions
{
    private const OPTION_MAP = [
        'ar' => 'ar',
        'artist' => 'artist',
        'bpm' => 'bpm',
        'circles' => 'countNormal',
        'created' => 'created',
        'creator' => 'creator',
        'cs' => 'cs',
        'difficulty' => 'difficulty',
        'dr' => 'drain',
        'favourites' => 'favouriteCount',
        'featured_artist' => 'featuredArtist',
        'keys' => 'keys',
        'length' => 'totalLength',
        'od' => 'accuracy',
        'ranked' => 'ranked',
        'sliders' => 'countSlider',
        'source' => 'source',
        'stars' => 'difficultyRating',
        'status' => 'statusRange',
        'tag' => 'tags',
        'title' => 'title',
        'updated' => 'updated',
    ];

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
    public ?string $difficultyRating = null;
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

    public function set(string $key, $value): void
    {
        $propName = self::OPTION_MAP[$key] ?? null;

        if ($propName !== null) {
            $this->$propName = $value;
        }
    }
}
