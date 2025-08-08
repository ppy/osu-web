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
            [['q' => 'featured_artist=1'], [0, 2, 4]],
            [['q' => '-featured_artist=1'], [1, 3, 5, 6]],
            [['c' => 'featured_artists'], [0, 1, 2, 3, 4, 5]],
            [
                ['c' => 'featured_artists', 'q' => '-featured_artist=1'],
                [1, 3, 5],
            ],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        static::withDbAccess(function () {
            $artists = Artist::factory()
                ->count(2)
                ->state(new Sequence(fn (Sequence $sequence) => ['id' => $sequence->index + 1]))
                ->create();

            // multiple tracks per artist
            $tracks = ArtistTrack::factory()
                ->count(4)
                ->state(new Sequence(fn (Sequence $sequence) => ['artist_id' => $artists[$sequence->index % 2]]))
                ->create();

            // multiple beatmapsets on at least one track
            static::$beatmapsets = Beatmapset::factory()
                ->ranked()
                ->withBeatmaps()
                ->count(6)
                ->state(new Sequence(fn (Sequence $sequence) => ['track_id' => $tracks[$sequence->index % 4]]))
                ->create();

            // extra non-featured artist beatmapset
            static::$beatmapsets[] = Beatmapset::factory()
                ->ranked()
                ->withBeatmaps()
                ->create();

            static::refresh();
        });
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
