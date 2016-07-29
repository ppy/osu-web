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
use Request;

class ArtistsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        return view('artists.index')
            ->with('artists', Artist::all());
    }

    public function show($id)
    {
        $artist = Artist::with('label')->findOrFail($id);
        $tracks = $artist->tracks()->get();

        return view('artists.show')
            ->with('artist', $artist)
            ->with('tracks', $tracks);
    }
}
