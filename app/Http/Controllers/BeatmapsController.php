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
namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Transformers\ScoreTransformer;
use App\Libraries\ModsHelper;
use Request;
use Auth;

class BeatmapsController extends Controller
{
    protected $section = 'beatmaps';

    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $set = $beatmap->beatmapset;

        return ujs_redirect(route('beatmapsets.show', ['id' => $set->beatmapset_id]).'#'.$beatmap->mode.'/'.$id);
    }

    public function scores($id)
    {
        $type = Request::input('type', 'global');

        $user = Auth::user();

        if ($type !== 'global') {
            if (!$user) {
                abort(403);
            } elseif (!$user->isSupporter()) {
                return error_popup(trans('errors.supporter_only'));
            }
        }

        $beatmap = Beatmap::findOrFail($id);
        $mode = Request::input('mode', Beatmap::modeStr($beatmap->playmode));
        $enabled_mods = Request::input('enabledMods');

        try {
            $query = $beatmap
                ->scoresBest($mode)
                ->defaultListing()
                ->with('user');
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
        }

        if ($enabled_mods) {
            if (!$user->isSupporter()) {
                return error_popup(trans('errors.supporter_only'));
            }

            $mods_bitset = ModsHelper::getModsValue($enabled_mods);

            $queryString = '((enabled_mods';

            if ($enabled_mods === ['NM']) {
                $queryString .= ' = 0))';
            }

            if (in_array('NM', $enabled_mods, true) && count($enabled_mods) > 1) {
                $queryString .= " & {$mods_bitset} = {$mods_bitset}) or enabled_mods = 0)";
            }

            if (!in_array('NM', $enabled_mods, true)) {
                $queryString .= " & {$mods_bitset} = {$mods_bitset}))";
            }

            $query->whereRaw($queryString);
        }

        switch ($type) {
            case 'country':
                $query
                    ->whereHas('user', function ($query) use (&$user) {
                        $query->where('country_acronym', $user->country_acronym);
                    });
                break;
            case 'friend':
                $query
                    ->whereIn('user_id', model_pluck($user->friends(), 'zebra_id'));
                break;
        }

        $scores = fractal_collection_array($query->get(), new ScoreTransformer, 'user');
        $userScore = null;
        $userScorePosition = null;

        if ($user) {
            $score = $beatmap->scoresBest()->where('user_id', $user->user_id)->with('user')->first();

            if (!$enabled_mods) {
                $enabled_mods = [];
            }

            if ($score && (empty(array_diff($enabled_mods, $score->enabled_mods)) || empty($score->enabled_mods))) {
                $userScore = fractal_item_array($score, new ScoreTransformer, 'user');
                $userScorePosition = $query->limit(null)->where('score', '>', $score->score)->count() + 1;
            }
        }

        return [
            'scoresList' => $scores,
            'userScore' => $userScore,
            'userScorePosition' => $userScorePosition,
        ];
    }
}
