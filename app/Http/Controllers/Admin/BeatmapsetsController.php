<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Http\Controllers\Admin;

use App\Models\Beatmapset;
use App\Jobs\RegenerateBeatmapsetCover;

class BeatmapsetsController extends Controller
{
    protected $section = 'admin.beatmapsets';

    public function covers($id)
    {
        $beatmapSet = Beatmapset::findOrFail($id);

        return view('admin.beatmapsets.cover', compact('beatmapSet'));
    }

    public function regenerateCovers($id)
    {
        $beatmapSet = Beatmapset::findOrFail($id);

        $job = (new RegenerateBeatmapsetCover($beatmapSet))->onQueue('beatmap_processor');
        $this->dispatch($job);

        return back();
    }

    public function show($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        return view('admin.beatmapsets.show', compact('beatmapset'));
    }
}
