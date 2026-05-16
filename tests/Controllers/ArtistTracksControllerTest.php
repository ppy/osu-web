<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Artist;
use App\Models\ArtistTrack;
use Tests\TestCase;

class ArtistTracksControllerTest extends TestCase
{
    public function testShowRedirectsToArtistPageTrackAnchor(): void
    {
        $artist = Artist::factory()->create();
        $track = ArtistTrack::factory()->create(['artist_id' => $artist->getKey()]);

        $this
            ->get(route('tracks.show', $track))
            ->assertRedirect(route('artists.show', $artist)."#track-{$track->getKey()}");
    }
}
