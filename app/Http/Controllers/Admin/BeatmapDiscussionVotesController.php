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

use App\Models\BeatmapDiscussionVote;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatmapDiscussionVotesController extends Controller
{
    protected $section = 'admin';
    protected $actionPrefix = 'beatmap_discussion_votes-';

    public function index()
    {
        $search = BeatmapDiscussionVote::search(request());
        $votes = new LengthAwarePaginator(
            $search['query']->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => route('admin.beatmap-discussion-votes.index'),
                'query' => $search['params'],
            ]
        );

        return view('admin.beatmap_discussion_votes.index', compact('votes'));
    }
}
