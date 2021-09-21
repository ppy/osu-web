<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\ArtistTrack;

class ArtistTracksController extends Controller
{
    public function show($id)
    {
        $track = ArtistTrack::findOrFail($id);
        $artist = $track->artist;

        if ($artist === null) {
            abort(404);
        }

        return ujs_redirect(route('artists.show', $artist));
    }
}
