<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Transformers\ArtistAlbumTransformer;
use App\Transformers\ArtistTrackTransformer;
use Auth;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Artist::with('label')->withMax('tracks', 'created_at')->withCount('tracks')->orderBy('name', 'asc');
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
                'title' => osu_trans('artist.links.osu'),
                'url' => route('users.show', $artist->user_id),
                'icon' => 'fas fa-user',
                'class' => 'osu',
            ];
        }

        if ($artist->beatmapsets()->count() > 0) {
            $links[] = [
                'title' => osu_trans('artist.links.beatmaps'),
                'url' => route('beatmapsets.index', ['q' => "featured_artist={$artist->getKey()}"]),
                'icon' => 'fas fa-bars',
                'class' => 'osu',
            ];
        }

        if ($artist->website) {
            $links[] = [
                'title' => osu_trans('artist.links.site'),
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
            'albums' => json_collection($albums, new ArtistAlbumTransformer(), ['tracks']),
            'tracks' => json_collection($tracks, new ArtistTrackTransformer()),
            'images' => $images,
        ]);
    }
}
