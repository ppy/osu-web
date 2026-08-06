<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Artist;
use App\Models\ArtistTrack;
use App\Models\Beatmapset;
use Illuminate\Database\Eloquent\Factories\Sequence;

class FeaturedArtistFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'featured_artist=1'], [4, 2, 0]],
            [['c' => 'featured_artists'], [5, 4, 3, 2, 1, 0]],
            [['q' => '-featured_artist=1'], [6, 5, 3, 1]],
            [['c' => 'featured_artists'], [5, 4, 3, 2, 1, 0]],
            [
                ['c' => 'featured_artists', 'q' => '-featured_artist=1'],
                [5, 3, 1],
            ],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $artists = Artist::factory()
                ->count(2)
                ->state(new Sequence(fn(Sequence $sequence): array => ['id' => $sequence->index + 1]))
                ->create();

            // multiple tracks per artist
            $tracks = ArtistTrack::factory()
                ->count(4)
                ->state(new Sequence(fn(Sequence $sequence): array => ['artist_id' => $artists[$sequence->index % 2]]))
                ->create();

            // multiple beatmapsets on at least one track
            static::$beatmapsets = Beatmapset::factory()
                ->ranked()
                ->withBeatmaps()
                ->count(6)
                ->state(new Sequence(fn(Sequence $sequence): array => ['track_id' => $tracks[$sequence->index % 4]]))
                ->create();

            // extra non-featured artist beatmapset
            static::$beatmapsets[] = Beatmapset::factory()
                ->ranked()
                ->withBeatmaps()
                ->create();
        });

        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        static::withDbAccess(function () {
            ArtistTrack::truncate();
            Artist::query()->delete(); // can't truncate with foreign key.
        });
    }
}
