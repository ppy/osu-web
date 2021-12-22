<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\ScorePin;
use Illuminate\Database\Eloquent\Relations\Relation;

class ScorePinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function destroy()
    {
        $params = $this->getScoreParams();

        auth()->user()->scorePins()->where($params)->first()?->delete();

        return response()->noContent();
    }

    public function store()
    {
        $params = $this->getScoreParams();

        abort_if(!ScorePin::isValidType($params['score_type']), 422, 'invalid score_type');

        $score = Relation::getMorphedModel($params['score_type'])::find($params['score_id']);

        abort_if($score === null, 422, "specified score couldn't be found");

        $user = auth()->user();

        $pin = ScorePin::where(['user_id' => $user->getKey()])->whereMorphedTo('score', $score)->first();

        if ($pin === null) {
            priv_check('ScorePin', $score)->ensureCan();

            $displayOrder = ($user->scorePins()->where('score_type', $score->getMorphClass())->min('display_order') ?? 2500) - 100;

            (new ScorePin(['display_order' => $displayOrder]))
                ->user()->associate($user)
                ->score()->associate($score)
                ->saveOrExplode();
        }

        return response()->noContent();
    }

    private function getScoreParams()
    {
        return get_params(request()->all(), null, [
            'score_type:string',
            'score_id:int',
        ], ['null_missing' => true]);
    }
}
