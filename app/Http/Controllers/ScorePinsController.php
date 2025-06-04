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

    public function destroy($scoreId)
    {
        \Auth::user()->scorePins()->whereKey($scoreId)->delete();

        return response()->noContent();
    }

    public function reorder($scoreId)
    {
        $params = get_params(\Request::all(), null, [
            'after_score_id:int',
            'before_score_id:int',
        ]);

        $pinsQuery = \Auth::user()->scorePins();
        $target = $pinsQuery->clone()->findOrFail(get_int($scoreId));
        $pinsQuery->where('ruleset_id', $target->ruleset_id);

        $order1Item = isset($params['after_score_id'])
            ? $pinsQuery->clone()->find($params['after_score_id'])
            : null;
        $order3Item = $order1Item === null && isset($params['before_score_id'])
            ? $pinsQuery->clone()->find($params['before_score_id'])
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

    public function store($scoreId)
    {
        $score = Solo\Score::find($scoreId);

        abort_if($score === null, 422, "specified score couldn't be found");

        $user = \Auth::user();

        $pin = $user->scorePins()->find($scoreId);

        if ($pin === null) {
            priv_check('ScorePin', $score)->ensureCan();

            $rulesetId = $score->ruleset_id;
            $currentMinDisplayOrder = $user->scorePins()->where('ruleset_id', $rulesetId)->min('display_order') ?? 2500;

            try {
                (new ScorePin([
                    'display_order' => $currentMinDisplayOrder - 100,
                    'ruleset_id' => $rulesetId,
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
