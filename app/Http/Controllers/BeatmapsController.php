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
        $beatmap = Beatmap::findOrFail($id);
        $mode = Request::input('mode', Beatmap::modeStr($beatmap->playmode));
        $mods = Request::input('enabledMods');
        $type = Request::input('type', 'global');
        $user = Auth::user();

        if (!is_array($mods)) {
            $mods = [];
        }

        if ($type !== 'global' || !empty($mods)) {
            if ($user === null || !$user->isSupporter()) {
                return error_popup(trans('errors.supporter_only'));
            }
        }

        try {
            $query = $beatmap
                ->scoresBest($mode)
                ->defaultListing()
                ->with('user');
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
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

        $scoresList = json_collection($query->get(), new ScoreTransformer, 'user');

        if ($user !== null) {
            $score = (clone $query)->where('user_id', $user->user_id)->first();

            if ($score !== null) {
                $userScore = json_item($score, new ScoreTransformer, 'user');
                $userScorePosition = 1 + (clone $query)
                    ->limit(null)
                    ->where('score', '>', $score->score)
                    ->count();
            }
        }

        return [
            'scoresList' => $scoresList,
            'userScore' => $userScore ?? null,
            'userScorePosition' => $userScorePosition ?? null,
        ];
    }
}
