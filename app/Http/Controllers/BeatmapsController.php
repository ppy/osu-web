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
        $set = Beatmap::findOrFail($id)->beatmapSet;

        return ujs_redirect(route('beatmapsets.show', ['id' => $set->beatmapset_id]).'#'.$id);
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

        $scores = $beatmap
            ->scoresBest()
            ->defaultListing()
            ->limit(config('osu.beatmaps.max-scores'))
            ->with('user');

        switch ($type) {
            case 'country':
                $scores = $scores
                    ->whereHas('user', function ($query) use (&$user) {
                        $query->where('country_acronym', $user->country_acronym);
                    });
                break;
            case 'friend':
                $scores = $scores
                    ->whereIn('user_id', $user->friends()->lists('zebra_id')->all());
                break;
        }

        return fractal_collection_array($scores->get(), new ScoreTransformer, 'user');
    }
}
