<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        priv_check('BeatmapDiscussionModerate')->ensureCan();

        $search = BeatmapsetEvent::search(request());
        $events = new LengthAwarePaginator(
            $search['query']->with(['user', 'beatmapset'])->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => route('beatmapsets.events.index'),
                'query' => $search['params'],
            ]
        );

        return view('beatmapset_events.index', compact('events'));
    }
}
