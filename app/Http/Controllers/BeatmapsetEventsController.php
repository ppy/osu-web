<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers;

use App\Models\BeatmapsetEvent;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatmapsetEventsController extends Controller
{
    protected $section = 'beatmaps';
    protected $actionPrefix = 'beatmapset_events-';

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
