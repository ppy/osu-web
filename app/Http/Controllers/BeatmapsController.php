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

namespace App\Http\Controllers;

use App\Exceptions\ScoreRetrievalException;
use App\Models\Beatmap;
use Auth;
use Request;

class BeatmapsController extends Controller
{
    protected $section = 'beatmaps';

    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $set = $beatmap->beatmapset;

        return ujs_redirect(route('beatmapsets.show', ['beatmap' => $set->beatmapset_id]).'#'.$beatmap->mode.'/'.$id);
    }

    public function scores($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $mode = presence(Request::input('mode')) ?? $beatmap->mode;
        $mods = get_arr(Request::input('mods'), 'presence') ?? [];
        $type = Request::input('type', 'global');
        $user = Auth::user();

        if ($beatmap->approved <= 0) {
            return ['scores' => []];
        }

        try {
            if ($type !== 'global' || !empty($mods)) {
                if ($user === null || !$user->isSupporter()) {
                    throw new ScoreRetrievalException(trans('errors.supporter_only'));
                }
            }

            $query = $beatmap
                ->scoresBest($mode)
                ->with('user.country')
                ->defaultListing();
        } catch (ScoreRetrievalException $ex) {
            return error_popup($ex->getMessage());
        }

        $query->withMods($mods);
        $query->withType($type, compact('user'));

        $results = [
            'scores' => json_collection($query->forListing(), 'Score', ['user', 'user.country']),
        ];

        if ($user !== null) {
            $score = (clone $query)->where('user_id', $user->user_id)->first();

            if ($score !== null) {
                $results['userScore'] = [
                    'position' => $score->userRank(compact('type', 'mods')),
                    'score' => json_item($score, 'Score', ['user', 'user.country']),
                ];
            }
        }

        return $results;
    }
}
