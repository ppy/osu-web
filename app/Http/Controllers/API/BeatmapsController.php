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
namespace App\Http\Controllers\API;

use Response;
use Request;
use Authorizer;
use App\Transformers\API\ScoreTransformer;
use App\Transformers\API\BeatmapTransformer;
use App\Models\User;
use App\Models\Beatmap;

class BeatmapsController extends Controller
{
    public function scores()
    {
        $current_user = User::find(Authorizer::getResourceOwnerId());

        // FIXME: scores are obtained via filename/checksum lookup for legacy reason (temporarily)
        $filename = Request::input('f');
        $checksum = Request::input('c');
        $per_page = min(Request::input('n', 50), 50);
        $page = max(Request::input('p', 1), 1);

        $beatmap = Beatmap::where('filename', $filename)->where('checksum', $checksum)->first();

        if (!$beatmap) {
            return Response::json(['error' => 'not_found']);
        }

        $beatmap_meta = fractal_api_serialize_item(
            $beatmap,
            new BeatmapTransformer()
        );

        $scores = $beatmap->scoresBest()->defaultScope()->offset(($page - 1) * $per_page)->limit($per_page);

        if ($beatmap->approved >= 1) {
            $beatmap_scores = fractal_api_serialize_collection(
                $scores->get(),
                new ScoreTransformer()
            );
        } else {
            $beatmap_scores = [];
        }

        return Response::json(['beatmap' => $beatmap_meta, 'scores' => $beatmap_scores]);
    }
}
