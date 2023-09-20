<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits\Es;

use Carbon\Carbon;

trait ArtistTrackSearch
{
    use BaseDbIndexable;

    public static function esIndexingQuery()
    {
        return static::with(['artist', 'album']);
    }

    public function esShouldIndex()
    {
        // use getAttribute because otherwise it'll return value of Eloquent's $visible field instead.
        return $this->artist->getAttribute('visible') && ($this->album === null || $this->album->getAttribute('visible'));
    }

    public function toEsJson()
    {
        $mappings = static::esMappings();

        $document = [];
        foreach ($mappings as $field => $mapping) {
            $value = match ($field) {
                'album' => $this->album?->title,
                'album_romanized' => $this->album?->title_romanized,
                'artist' => $this->artist->name,
                default => $this->$field,
            };

            if ($value instanceof Carbon) {
                $value = $value->toIso8601String();
            }

            $document[$field] = $value;
        }

        return $document;
    }
}
