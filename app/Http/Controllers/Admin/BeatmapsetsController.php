<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

use App\Jobs\RegenerateBeatmapsetCover;
use App\Jobs\RemoveBeatmapsetCover;
use App\Models\Beatmapset;
use Request;

class BeatmapsetsController extends Controller
{
    public function covers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        return ext_view('admin.beatmapsets.cover', compact('beatmapset'));
    }

    public function removeCovers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $job = (new RemoveBeatmapsetCover($beatmapset))->onQueue('beatmap_high');
        $this->dispatch($job);

        return response([], 204);
    }

    public function regenerateCovers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $job = (new RegenerateBeatmapsetCover($beatmapset))->onQueue('beatmap_high');
        $this->dispatch($job);

        return response([], 204);
    }

    public function show($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        return ext_view('admin.beatmapsets.show', compact('beatmapset'));
    }

    public function update($id)
    {
        $params = get_params(Request::input(), 'beatmapset', ['discussion_enabled:bool']);

        $beatmapset = Beatmapset::findOrFail($id);
        $beatmapset->update($params);

        return ujs_redirect(route('admin.beatmapsets.show', $beatmapset));
    }
}
