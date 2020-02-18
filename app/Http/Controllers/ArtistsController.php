<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Transformers\ArtistAlbumTransformer;
use App\Transformers\ArtistTrackTransformer;
use Auth;

class ArtistsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        $artists = Artist::with('label')->withCount('tracks')->orderBy('name', 'asc');
        $user = Auth::user();

        if ($user === null || !$user->isAdmin()) {
            $artists->where('visible', true);
        }

        return ext_view('artists.index', [
            'artists' => $artists->get(),
        ]);
    }

    public function show($id)
    {
        $artist = Artist::with('label')->findOrFail($id);
        $user = Auth::user();

        if (!$artist->visible && ($user === null || !$user->isAdmin())) {
            abort(404);
        }

        $albums = $artist->albums()
            ->where('visible', true)
            ->orderBy('id', 'desc')
            ->with(['tracks' => function ($query) {
                $query->orderBy('display_order', 'ASC');
            }])
            ->with('tracks.artist')
            ->get();

        $tracks = $artist
            ->tracks()
            ->whereNull('album_id')
            ->with('artist')
            ->orderBy('id', 'desc')
            ->get();

        $images = [
            'header_url' => $artist->header_url,
            'cover_url' => $artist->cover_url,
        ];

        // should probably move services to a separate model if the number increases further (HA HA HA)
        $links = [];

        if ($artist->user_id) {
            $links[] = [
                'title' => trans('artist.links.osu'),
                'url' => route('users.show', $artist->user_id),
                'icon' => 'fas fa-user',
                'class' => 'osu',
            ];
        }

        if ($artist->website) {
            $links[] = [
                'title' => trans('artist.links.site'),
                'url' => $artist->website,
                'icon' => 'fas fa-link',
                'class' => 'website',
            ];
        }

        foreach (['twitter', 'facebook', 'spotify', 'bandcamp', 'patreon', 'soundcloud', 'youtube'] as $service) {
            if ($artist->$service) {
                $links[] = [
                    'title' => $service === 'youtube' ? 'YouTube' : ucwords($service),
                    'url' => $artist->$service,
                    'icon' => "fab fa-{$service}",
                    'class' => $service,
                ];
            }
        }

        return ext_view('artists.show', [
            'artist' => $artist,
            'links' => $links,
            'albums' => json_collection($albums, new ArtistAlbumTransformer, ['tracks']),
            'tracks' => json_collection($tracks, new ArtistTrackTransformer),
            'images' => $images,
        ]);
    }
}
