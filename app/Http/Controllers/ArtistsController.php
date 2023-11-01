<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Transformers\ArtistAlbumTransformer;
use App\Transformers\ArtistTrackTransformer;
use App\Transformers\ArtistTransformer;
use Auth;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Artist::with('label')->withMax('tracks', 'created_at')->withCount('tracks')->orderBy('name', 'asc');
        $user = Auth::user();

        if ($user === null || !$user->isGroup('admin')) {
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

        if (!$artist->visible && ($user === null || !$user->isGroup('admin'))) {
            abort(404);
        }

        $albums = $artist->albums()
            ->where('visible', true)
            ->orderBy('id', 'desc')
            ->with(['tracks' => fn ($q) => $q
                    ->orderBy('display_order', 'asc')
                    ->orderBy('exclusive', 'desc')
                    ->orderBy('id', 'asc'),
            ])
            ->get();

        $tracks = $artist
            ->tracks()
            ->whereNull('album_id')
            ->orderBy('display_order', 'asc')
            ->orderBy('exclusive', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($albums as $album) {
            foreach ($album->tracks as $track) {
                $track->setRelation('album', $album);
                $track->setRelation('artist', $artist);
            }
        }
        foreach ($tracks as $track) {
            $track->setRelation('artist', $artist);
        }

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

        if ($artist->beatmapsets()->exists()) {
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

        foreach (['Twitter', 'Facebook', 'Spotify', 'Bandcamp', 'Patreon', 'SoundCloud', 'YouTube'] as $service) {
            $serviceLowercase = strtolower($service);
            if ($artist->$serviceLowercase) {
                $links[] = [
                    'title' => $service,
                    'url' => $artist->$serviceLowercase,
                    'icon' => "fab fa-{$serviceLowercase}",
                    'class' => $serviceLowercase,
                ];
            }
        }

        return ext_view('artists.show', [
            'artist' => $artist,
            'images' => $images,
            'json' => [
                'albums' => json_collection($albums, new ArtistAlbumTransformer(), ['tracks']),
                'artist' => json_item($artist, new ArtistTransformer()),
                'tracks' => json_collection($tracks, new ArtistTrackTransformer()),
            ],
            'links' => $links,
        ]);
    }
}
