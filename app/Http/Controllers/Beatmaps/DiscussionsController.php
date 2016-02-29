<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Http\Controllers\Beatmaps;

use Auth;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapsetDiscussion;
use Request;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' =>
            'index',
        ]);

        return parent::__construct();
    }

    public function create($beatmapId)
    {
        $beatmap = Beatmap::findOrFail($beatmapId);
        $beatmapsetDiscussion = BeatmapsetDiscussion::findOrFail($beatmap->beatmapset_id);

        $discussion = new BeatmapDiscussion([
            'beatmap_id' => $beatmap->beatmap_id,
            'beatmapset_discussion_id' => $beatmapsetDiscussion->id,
        ]);

        return view('beatmaps.discussions.create', compact('beatmap', 'discussion'));
    }

    public function index($beatmapId)
    {
        return Beatmap::findOrFail($beatmapId)->beatmapDiscussions;
    }

    public function store($beatmapId)
    {
        $beatmap = Beatmap::findOrFail($beatmapId);
        $beatmapsetDiscussion = BeatmapsetDiscussion::findOrFail($beatmap->beatmapset_id);

        $params = array_merge(
            get_params(Request::all(), 'beatmap_discussion', [
                'message',
                'message_type',
                'timestamp',
            ]),
            [
                'beatmap_id' => $beatmap->beatmap_id,
                'beatmapset_discussion_id' => $beatmapsetDiscussion->id,
                'user_id' => Auth::user()->user_id,
            ]
        );

        $discussion = BeatmapDiscussion::create($params);

        if ($discussion->id !== null) {
            return ujs_redirect(route('beatmaps.discussions.show', $beatmap, $discussion));
        } else {
            return view('beatmaps.discussions.create', compact('beatmap', 'discussion'));
        }
    }
}
