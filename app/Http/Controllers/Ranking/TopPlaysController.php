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

    public function show(string $rulesetName): Response
    {
        $rulesetId = Beatmap::MODES[$rulesetName] ?? abort(422, 'invalid ruleset parameter');
        $page = get_int(\Request::input('page')) ?? 1;
        if ($page < 1 || $page > static::PAGES) {
            abort(422, 'invalid page parameter');
        }
        $data = new TopPlays($rulesetId)->get();
        $scores = $data === null
            ? null
            : Score
                ::whereIntegerInRaw('id', $data['ids'])
                ->with('user.team')
                ->with('beatmap.beatmapset')
                ->whereHas('user')
                ->whereHas('beatmap.beatmapset')
                ->orderByDesc('pp')
                ->paginate(static::PAGE_SIZE, ['*'], 'page', $page, static::PAGE_SIZE * static::PAGES);

        $scoresJson = $scores === null
            ? null
            : json_collection($scores, new ScoreTransformer(), ['beatmap', 'beatmapset', 'user.country', 'user.team']);

        return ext_view('rankings.top_plays', compact(
            'rulesetName',
            'scores',
            'scoresJson',
        ));
    }
}
