<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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
use App\Transformers\ArtistTrackTransformer;

class ArtistsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        return view('artists.index')
            ->with('artists', Artist::with('label')->withCount('tracks')->where('visible', true)->get());
    }

    public function show($id)
    {
        $artist = Artist::with('label')->findOrFail($id);
        $tracks = $artist->tracks()->get();
        $images = [
            'header_url' => $artist->header_url,
            'cover_url' => $artist->cover_url,
        ];

        // should probably move services to a separate model if the number increases further
        $links = [];
        foreach (['soundcloud', 'twitter', 'facebook', 'bandcamp', 'patreon'] as $service) {
            if ($artist->$service) {
                $links[] = [
                    'title' => ucwords($service),
                    'url' => $artist->$service,
                    'icon' => $service === 'patreon' ? "extra-$service" : $service,
                    'class' => $service,
                ];
            }
        }

        if ($artist->website) {
            $links[] = [
                'title' => trans('artist.links.site'),
                'url' => $artist->website,
                'icon' => 'globe',
                'class' => 'website',
            ];
        }

        return view('artists.show')
            ->with('artist', $artist)
            ->with('links', $links)
            ->with('tracks', json_collection($tracks, new ArtistTrackTransformer()))
            ->with('images', $images);
    }
}
