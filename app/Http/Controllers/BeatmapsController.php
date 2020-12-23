<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ScoreRetrievalException;
use App\Models\Beatmap;
use App\Models\Score\Best\Model as BestModel;

class BeatmapsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $set = $beatmap->beatmapset;

        if ($set === null) {
            abort(404);
        }

        $requestedMode = presence(request('mode'));

        if (Beatmap::isModeValid($requestedMode) && $beatmap->mode === 'osu') {
            $mode = $requestedMode;
        } else {
            $mode = $beatmap->mode;
        }

        return ujs_redirect(route('beatmapsets.show', ['beatmapset' => $set->beatmapset_id]).'#'.$mode.'/'.$id);
    }

    /**
     * Get Beatmap scores
     *
     * Returns the top scores for a beatmap
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [BeatmapScores](#beatmapscores)
     *
     * @urlParam id required Id of the [Beatmap](#beatmap).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for.
     * @queryParam mods An array of matching Mods, or none // TODO.
     * @queryParam type Beatmap score ranking type // TODO.
     * @queryParam user_id The id of the [User](#user) to lookup scores for; usernames are not accepted. `userScore` will not be included in the response.
     */
    public function scores($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        if ($beatmap->approved <= 0) {
            return ['scores' => []];
        }

        $params = get_params(request()->all(), null, [
            'mode:string',
            'mods:any',
            'type:string',
            'user_id:int',
        ]);

        $mode = presence($params['mode'] ?? null, $beatmap->mode);
        $mods = get_arr($params['mods'] ?? null, 'presence') ?? [];
        $type = presence($params['type'] ?? null, 'global');
        $currentUser = auth()->user();
        $userId = presence($params['user_id'] ?? null);

        try {
            if ($type !== 'global' || !empty($mods)) {
                if ($currentUser === null || !$currentUser->isSupporter()) {
                    throw new ScoreRetrievalException(trans('errors.supporter_only'));
                }
            }

            $query = BestModel::getClassByString($mode)
                ::default()
                ->where('beatmap_id', $beatmap->getKey())
                ->with(['beatmap', 'user.country', 'user.userProfileCustomization'])
                ->withMods($mods)
                ->withType($type, ['user' => $currentUser]);

            if ($currentUser !== null && $userId === null) {
                // own score shouldn't be filtered by visibleUsers()
                $userScore = (clone $query)->where('user_id', $currentUser->user_id)->first();
            }

            $query->visibleUsers();

            if ($userId !== null) {
                $scores = $query->where('user_id', $userId)->limit(1)->get();
            } else {
                $scores = $query->forListing();
            }

            $results = [
                'scores' => json_collection($scores, 'Score', ['beatmap', 'user', 'user.country', 'user.cover']),
            ];

            if (isset($userScore)) {
                $results['userScore'] = [
                    'position' => $userScore->userRank(compact('type', 'mods')),
                    'score' => json_item($userScore, 'Score', ['user', 'user.country', 'user.cover']),
                ];
            }

            return $results;
        } catch (ScoreRetrievalException $ex) {
            return error_popup($ex->getMessage());
        }
    }
}
