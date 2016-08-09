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

        try {
            $scores = $beatmap
                ->scoresBest($mode)
                ->defaultListing()
                ->with('user');
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
        }

        switch ($type) {
            case 'country':
                $scores = $scores
                    ->whereHas('user', function ($query) use (&$user) {
                        $query->where('country_acronym', $user->country_acronym);
                    });
                break;
            case 'friend':
                $scores = $scores
                    ->whereIn('user_id', model_pluck($user->friends(), 'zebra_id'));
                break;
        }

        $scores = fractal_collection_array($scores->get(), new ScoreTransformer, 'user');
        $userScore = null;
        $userScorePosition = -1;

        if ($user) {
            $score = $beatmap->scoresBest()->where('user_id', $user->user_id)->with('user')->first();

            if ($score) {
                $userScore = fractal_item_array($score, new ScoreTransformer, 'user');
                $userScorePosition = $beatmap->scoresBest()->where('score', '>', $score->score)
                    ->orderBy('score', 'desc')->count() + 1;
            }
        }

        return [
            'scoresList' => $scores,
            'userScore' => $userScore,
            'userScorePosition' => $userScorePosition,
        ];
    }
}
