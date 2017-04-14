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
        $mode = Request::input('mode');
        $mods = Request::input('mods');
        $type = Request::input('type', 'global');
        $user = Auth::user();

        $mode = present($mode) ? Beatmap::modeStr($mode) : Beatmap::modeStr($beatmap->playmode);
        if (!present($mods) || !is_array($mods)) {
            $mods = [];
        }

        try {
            if ($type !== 'global' || !empty($mods)) {
                if ($user === null || !$user->isSupporter()) {
                    throw new ScoreRetrievalException(trans('errors.supporter_only'));
                }
            }

            $query = $beatmap
                ->scoresBest($mode)
                ->defaultListing();
        } catch (ScoreRetrievalException $ex) {
            if (Request::ajax()) {
                return error_popup($ex->getMessage());
            } else {
                return response(['error' => $ex->getMessage()], 422);
            }
        }

        $query->withMods($mods);

        switch ($type) {
            case 'country':
                $query->fromCountry($user->country_acronym);
                break;
            case 'friend':
                $query->friendsOf($user);
                break;
        }

        $results = [
            'scores' => json_collection($query->forListing(), 'Score', ['user']),
        ];

        if ($user !== null) {
            $score = (clone $query)->where('user_id', $user->user_id)->first();

            if ($score !== null) {
                $results['userScore'] = [
                    'position' => $query->userRank($score),
                    'score' => json_item($score, 'Score', ['user']),
                ];
            }
        }

        return $results;
    }
}
