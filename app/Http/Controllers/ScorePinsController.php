<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Jobs\RenumberUserScorePins;
use App\Models\ScorePin;
use App\Models\Solo;
use Exception;

class ScorePinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    public function destroy()
    {
        \Auth::user()->scorePins()->whereKey(get_int(request('score_id')))->delete();

        return response()->noContent();
    }

    public function reorder()
    {
        $rawParams = \Request::all();
        $targetId = get_int($rawParams['score_id'] ?? null);

        $pinsQuery = \Auth::user()->scorePins();
        $target = $pinsQuery->clone()->findOrFail($targetId);
        $rulesetId = $target->ruleset_id;
        $pinsQuery->where('ruleset_id', $rulesetId);

        $adjacentScores = [];
        foreach (['order1', 'order3'] as $position) {
            $adjacentScoreIds[$position] = get_int($rawParams[$position]['score_id'] ?? null);
        }

        $order1Item = isset($adjacentScoreIds['order1'])
            ? $pinsQuery->clone()->find($adjacentScoreIds['order1'])
            : null;
        $order3Item = $order1Item === null && isset($adjacentScoreIds['order3'])
            ? $pinsQuery->clone()->find($adjacentScoreIds['order3'])
            : null;

        abort_if($order1Item === null && $order3Item === null, 422, 'no valid pinned score reference is specified');

        if ($order1Item === null) {
            $order3 = $order3Item->display_order;
            $order1 = $pinsQuery->clone()->where('display_order', '<', $order3)->max('display_order')
                ?? $order3 - 200;
        } else {
            $order1 = $order1Item->display_order;
            $order3 = $pinsQuery->clone()->where('display_order', '>', $order1)->min('display_order')
                ?? $order1 + 200;
        }

        $order2 = ($order1 + $order3) / 2;

        if ($order3 - $order1 < 0.1) {
            dispatch(new RenumberUserScorePins($target->user_id, $target->ruleset_id));
        }

        $target->update(['display_order' => $order2]);

        return response()->noContent();
    }

    public function store()
    {
        $id = get_int(request('score_id'));
        $score = Solo\Score::find($id);

        abort_if($score === null, 422, "specified score couldn't be found");

        $user = \Auth::user();

        $pin = $user->scorePins()->find($id);

        if ($pin === null) {
            priv_check('ScorePin', $score)->ensureCan();

            $rulesetId = $score->ruleset_id;
            $currentMinDisplayOrder = $user->scorePins()->where('ruleset_id', $rulesetId)->min('display_order') ?? 2500;

            try {
                (new ScorePin([
                    'display_order' => $currentMinDisplayOrder - 100,
                    'ruleset_id' => $rulesetId,

                    /**
                     * TODO:
                     * 1. update score_id = new_score_id
                     * 2. remove duplicated score_id
                     * 3. use score_id as primary key (both model and database)
                     * 4. remove setting score_type below
                     * 5. remove new_score_id and score_type columns
                     */
                    'score_id' => $score->getKey(),
                    'score_type' => $score->getMorphClass(),
                ]))->user()->associate($user)
                    ->score()->associate($score)
                    ->saveOrExplode();
            } catch (Exception $ex) {
                if (!is_sql_unique_exception($ex)) {
                    throw $ex;
                }
            }

            $score->update(['preserve' => true]);
        }

        return response()->noContent();
    }
}
