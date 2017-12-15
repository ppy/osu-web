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

namespace App\Http\Controllers\Admin;

use App\Models\BeatmapDiscussion;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatmapDiscussionsController extends Controller
{
    protected $section = 'admin';
    protected $actionPrefix = 'beatmap_discussions-';

    public function index()
    {
        $search = BeatmapDiscussion::search(request());
        $discussions = new LengthAwarePaginator(
            $search['query']->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => route('admin.beatmap-discussions.index'),
                'query' => $search['params'],
            ]
        );

        return view('admin.beatmap_discussions.index', compact('discussions', 'search'));
    }
}
