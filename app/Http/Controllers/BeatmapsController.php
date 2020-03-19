<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ScoreRetrievalException;
use App\Models\Beatmap;
use App\Models\Score\Best\Model as BestModel;
use Auth;
use Request;

class BeatmapsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (is_api_request()) {
            $this->middleware('require-scopes:beatmaps.read');
        }
    }

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
        if ($beatmap->approved <= 0) {
            return ['scores' => []];
        }

        return with_db_fallback('mysql-readonly', function ($connection) use ($beatmap) {
            $mode = presence(Request::input('mode')) ?? $beatmap->mode;
            $mods = get_arr(Request::input('mods'), 'presence') ?? [];
            $type = Request::input('type', 'global');
            $user = Auth::user();

            try {
                if ($type !== 'global' || !empty($mods)) {
                    if ($user === null || !$user->isSupporter()) {
                        throw new ScoreRetrievalException(trans('errors.supporter_only'));
                    }
                }

                $class = BestModel::getClassByString($mode);
                $model = new $class;
                $model->setConnection($connection);

                $query = $model
                    ->default()
                    ->where('beatmap_id', $beatmap->getKey())
                    ->with(['beatmap', 'user.country'])
                    ->withMods($mods)
                    ->withType($type, compact('user'));

                if ($user !== null) {
                    $score = (clone $query)->where('user_id', $user->user_id)->first();
                }

                $results = [
                    'scores' => json_collection($query->visibleUsers()->forListing(), 'Score', ['beatmap', 'user', 'user.country']),
                ];

                if (isset($score)) {
                    $results['userScore'] = [
                        'position' => $score->userRank(compact('type', 'mods')),
                        'score' => json_item($score, 'Score', ['user', 'user.country']),
                    ];
                }

                return $results;
            } catch (ScoreRetrievalException $ex) {
                return error_popup($ex->getMessage());
            }
        });
    }
}
