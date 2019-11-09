<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers\API;

use App\Models\Beatmap;
use Request;

class BeatmapsController extends Controller
{
    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes']);
    }

    public function lookup()
    {
        $checksum = Request::input('checksum');
        $filename = urldecode(Request::input('filename'));

        // Try to look up via checksum
        if (present($checksum)) {
            $beatmap = Beatmap::where('checksum', $checksum)->first();
        }

        // If checksum is missing (or not found), try to look up by filename instead
        if (!isset($beatmap) && present($filename)) {
            $beatmap = Beatmap::where('filename', $filename)->firstOrFail();
        }

        if (!isset($beatmap)) {
            abort(404);
        }

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes']);
    }
}
