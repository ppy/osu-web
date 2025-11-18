<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Libraries\Score\TopPlays;
use App\Models\Beatmap;
use App\Models\Solo\Score;
use App\Transformers\ScoreTransformer;
use Symfony\Component\HttpFoundation\Response;

class TopPlaysController extends Controller
{
    const int PAGE_SIZE = 100;
    const int PAGES = 10; // top 1000

    public function show(?string $rulesetName = null): Response
    {
        if ($rulesetName === null) {
            return ujs_redirect(route('rankings.top-plays', ['mode' => default_mode()]));
        }

        $rulesetId = Beatmap::MODES[$rulesetName] ?? abort(422, 'invalid ruleset parameter');
        $page = \Number::clamp(get_int(\Request::input('page')) ?? 1, 1, static::PAGES);
        $data = new TopPlays($rulesetId)->get();

        if (isset($data)) {
            $lastUpdate = parse_time_to_carbon($data['time']);

            $scores = Score
                    ::whereIntegerInRaw('id', array_slice($data['ids'], 0, (int) ($page * static::PAGE_SIZE * 1.5)))
                    ->with('user.team')
                    ->with('beatmap.beatmapset')
                    ->whereHas('user')
                    ->whereHas('beatmap.beatmapset')
                    ->orderByDesc('pp')
                    ->paginate(static::PAGE_SIZE, ['*'], 'page', $page, static::PAGE_SIZE * static::PAGES);

            $scoresJson = json_collection(
                $scores,
                new ScoreTransformer(),
                ['beatmap', 'beatmapset', 'user.country', 'user.team'],
            );
        } else {
            $lastUpdate = null;
            $scores = null;
            $scoresJson = null;
        }

        return ext_view('rankings.top_plays', compact(
            'lastUpdate',
            'rulesetName',
            'scores',
            'scoresJson',
        ));
    }
}
