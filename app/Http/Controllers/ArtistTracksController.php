<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\Search\ArtistTrackSearch;
use App\Libraries\Search\ArtistTrackSearchParamsFromRequest;
use App\Models\ArtistTrack;

class ArtistTracksController extends Controller
{
    public function index()
    {
        $params = ArtistTrackSearchParamsFromRequest::fromArray(request()->all());
        $search = new ArtistTrackSearch($params);

        $data = [
            'artist_tracks' => json_collection($search->records(), 'ArtistTrack', ['artist', 'album']),
            'search' => ArtistTrackSearchParamsFromRequest::toArray($params),
            'cursor' => $search->getSortCursor(),
        ];

        if (is_json_request()) {
            return $data;
        }

        $availableGenres = cache_remember_mutexed(
            'artist_track_genres',
            600,
            [],
            fn () => ArtistTrack::distinct()->pluck('genre')->sort()->values(),
        );

        return ext_view('artist_tracks.index', compact('availableGenres', 'data'));
    }

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
