<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Exceptions\ScoreRetrievalException;
use App\Models\Beatmap;
use App\Models\Score\Best\Model as BestModel;
use Auth;
use DB;
use Request;

class BeatmapsController extends Controller
{
    protected $section = 'beatmaps';

    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $set = $beatmap->beatmapset;

        if ($set === null) {
            abort(404);
        }

        return ujs_redirect(route('beatmapsets.show', ['beatmapset' => $set->beatmapset_id]).'#'.$beatmap->mode.'/'.$id);
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

            $class = BestModel::getClassByString($mode);
            $table = (new $class)->getTable();
            $query = $beatmap
                ->scoresBest($mode)
                ->with(['beatmap', 'user.country'])
                ->from(DB::raw("{$table} FORCE INDEX (beatmap_score_lookup)"))
                ->defaultListing();
        } catch (ScoreRetrievalException $ex) {
            return error_popup($ex->getMessage());
        }

        $query->withMods($mods);
        $query->withType($type, compact('user'));

        $results = [
            'scores' => json_collection($query->forListing(), 'Score', ['beatmap', 'user', 'user.country']),
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
