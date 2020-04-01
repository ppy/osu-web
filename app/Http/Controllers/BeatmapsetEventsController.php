<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\BeatmapsetEvent;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatmapsetEventsController extends Controller
{
    public function index()
    {
        $params = request()->all();
        $params['is_moderator'] = priv_check('BeatmapDiscussionModerate')->can();
        $params['is_kudosu_moderator'] = priv_check('BeatmapDiscussionAllowOrDenyKudosu')->can();

        $search = BeatmapsetEvent::search($params);

        return ext_view('beatmapset_events.index', [
            'search' => $search,
            'events' => new LengthAwarePaginator(
                $search['query']->with(['user', 'beatmapset', 'beatmapset.user'])->get(),
                $search['query']->realCount(),
                $search['params']['limit'],
                $search['params']['page'],
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'query' => $search['params'],
                ]
            ),
        ]);
    }
}
