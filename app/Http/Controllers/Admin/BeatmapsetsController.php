<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Jobs\RegenerateBeatmapsetCover;
use App\Jobs\RemoveBeatmapsetCover;
use App\Models\Beatmapset;
use Request;

class BeatmapsetsController extends Controller
{
    protected $section = 'admin';
    protected $actionPrefix = 'beatmapsets-';

    public function covers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        return view('admin.beatmapsets.cover', compact('beatmapset'));
    }

    public function removeCovers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $job = (new RemoveBeatmapsetCover($beatmapset))->onQueue('beatmap_processor');
        $this->dispatch($job);

        return response([], 204);
    }

    public function regenerateCovers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $job = (new RegenerateBeatmapsetCover($beatmapset))->onQueue('beatmap_processor');
        $this->dispatch($job);

        return response([], 204);
    }

    public function show($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        return view('admin.beatmapsets.show', compact('beatmapset'));
    }

    public function update($id)
    {
        $params = get_params(Request::input(), 'beatmapset', ['discussion_enabled:bool']);

        $beatmapset = Beatmapset::findOrFail($id);
        $beatmapset->update($params);

        return ujs_redirect(route('admin.beatmapsets.show', $beatmapset));
    }
}
