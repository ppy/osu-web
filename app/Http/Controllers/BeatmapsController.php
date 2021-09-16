<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ScoreRetrievalException;
use App\Jobs\Notifications\BeatmapOwnerChange;
use App\Models\Beatmap;
use App\Models\BeatmapsetEvent;
use App\Models\Score\Best\Model as BestModel;

/**
 * @group Beatmaps
 */
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
        $beatmapset = $beatmap->beatmapset;

        if ($beatmapset === null) {
            abort(404);
        }

        if ($beatmap->mode === 'osu') {
            $params = get_params(request()->all(), null, [
                'm:int', // legacy parameter
                'mode:string',
            ], ['null_missing' => true]);

            $mode = Beatmap::isModeValid($params['mode'])
                ? $params['mode']
                : Beatmap::modeStr($params['m']);
        }

        $mode ??= $beatmap->mode;

        return ujs_redirect(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]).'#'.$mode.'/'.$beatmap->getKey());
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
     * @urlParam beatmap integer required Id of the [Beatmap](#beatmap).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for.
     * @queryParam mods An array of matching Mods, or none // TODO.
     * @queryParam type Beatmap score ranking type // TODO.
     */
    public function scores($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        if ($beatmap->approved <= 0) {
            return ['scores' => []];
        }

        $params = get_params(request()->all(), null, [
            'mode:string',
            'mods:string[]',
            'type:string',
        ]);

        $mode = presence($params['mode'] ?? null, $beatmap->mode);
        $mods = array_values(array_filter($params['mods'] ?? []));
        $type = presence($params['type'] ?? null, 'global');
        $currentUser = auth()->user();

        try {
            if ($type !== 'global' || !empty($mods)) {
                if ($currentUser === null || !$currentUser->isSupporter()) {
                    throw new ScoreRetrievalException(osu_trans('errors.supporter_only'));
                }
            }

            $query = static::baseScoreQuery($beatmap, $mode, $mods, $type);

            if ($currentUser !== null) {
                // own score shouldn't be filtered by visibleUsers()
                $userScore = (clone $query)->where('user_id', $currentUser->user_id)->first();
            }

            $results = [
                'scores' => json_collection($query->visibleUsers()->forListing(), 'Score', ['beatmap', 'user', 'user.country', 'user.cover']),
            ];

            if (isset($userScore)) {
                // TODO: this should be moved to user_score
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

    public function updateOwner($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $currentUser = auth()->user();

        priv_check('BeatmapUpdateOwner', $beatmap->beatmapset)->ensureCan();

        $newUserId = get_int(request('beatmap.user_id'));

        $beatmap->getConnection()->transaction(function () use ($beatmap, $currentUser, $newUserId) {
            $beatmap->setOwner($newUserId);

            BeatmapsetEvent::log(BeatmapsetEvent::BEATMAP_OWNER_CHANGE, $currentUser, $beatmap->beatmapset, [
                'beatmap_id' => $beatmap->getKey(),
                'beatmap_version' => $beatmap->version,
                'new_user_id' => $beatmap->user_id,
                'new_user_username' => $beatmap->user->username,
            ])->saveOrExplode();
        });

        if ($beatmap->user_id !== $currentUser->getKey()) {
            (new BeatmapOwnerChange($beatmap, $currentUser))->dispatch();
        }

        return $beatmap->beatmapset->defaultDiscussionJson();
    }

    /**
     * Get a User Beatmap score
     *
     * Return a [User](#user)'s score on a Beatmap
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [BeatmapUserScore](#beatmapuserscore)
     *
     * The position returned depends on the requested mode and mods.
     *
     * @urlParam beatmap integer required Id of the [Beatmap](#beatmap).
     * @urlParam user integer required Id of the [User](#user).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for.
     * @queryParam mods An array of matching Mods, or none // TODO.
     */
    public function userScore($beatmapId, $userId)
    {
        $beatmap = Beatmap::scoreable()->findOrFail($beatmapId);

        $params = get_params(request()->all(), null, [
            'mode:string',
            'mods:string[]',
        ]);

        $mode = presence($params['mode'] ?? null, $beatmap->mode);
        $mods = array_values(array_filter($params['mods'] ?? []));

        try {
            $score = static::baseScoreQuery($beatmap, $mode, $mods)
                ->visibleUsers()
                ->where('user_id', $userId)
                ->firstOrFail();

            return [
                'position' => $score->userRank(compact('mods')),
                'score' => json_item($score, 'Score', ['beatmap', 'user', 'user.country', 'user.cover']),
            ];
        } catch (ScoreRetrievalException $ex) {
            return error_popup($ex->getMessage());
        }
    }

    private static function baseScoreQuery(Beatmap $beatmap, $mode, $mods, $type = null)
    {
        $query = BestModel::getClassByString($mode)
            ::default()
            ->where('beatmap_id', $beatmap->getKey())
            ->with(['beatmap', 'user.country', 'user.userProfileCustomization'])
            ->withMods($mods);

        if ($type !== null) {
            $query->withType($type, ['user' => auth()->user()]);
        }

        return $query;
    }
}
