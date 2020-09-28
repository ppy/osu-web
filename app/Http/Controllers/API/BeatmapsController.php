<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\API;

use App\Models\Beatmap;

class BeatmapsController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public');
    }

    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes', 'max_combo']);
    }

    public function lookup()
    {
        $params = get_params(request()->all(), null, ['checksum:string', 'filename:string', 'id:int']);

        // Try to look up via checksum
        if (present($params['checksum'] ?? null)) {
            $beatmap = Beatmap::where('checksum', $params['checksum'])->first();
        }

        // And then via id if checksum lookup doesn't yield anything
        if (!isset($beatmap) && isset($params['id'])) {
            $beatmap = Beatmap::find($params['id']);
        }

        // Lastly, try to look up by filename
        if (!isset($beatmap) && present($params['filename'] ?? null)) {
            $beatmap = Beatmap::where('filename', $params['filename'])->first();
        }

        if (!isset($beatmap)) {
            abort(404);
        }

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes', 'max_combo']);
    }
}
