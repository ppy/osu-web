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
use App\Models\BeatmapDiscussionReply;
use App\Models\BeatmapsetDiscussion;
use Request;

class DiscussionRepliesController extends Controller
{
    // the beatmap id isn't actually needed in most cases
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);

        return parent::__construct();
    }

    public function create($beatmapId, $beatmapDiscussionId)
    {
        $discussion = BeatmapDiscussion::findOrFail($beatmapDiscussionId);

        $reply = new BeatmapDiscussionReply([
            'beatmap_discussion_id' => $discussion->id,
        ]);

        return view('beatmaps.discussion-replies.create', compact('discussion', 'reply'));
    }

    public function store($beatmapId, $beatmapDiscussionId)
    {
        $discussion = BeatmapDiscussion::findOrFail($beatmapDiscussionId);

        $params = array_merge(
            get_params(Request::all(), 'beatmap_discussion_reply', [
                'message',
            ]),
            [
                'beatmap_discussion_id' => $discussion->id,
                'user_id' => Auth::user()->user_id,
            ]
        );

        $reply = BeatmapDiscussionReply::create($params);

        if ($discussion->id !== null) {
            return ujs_redirect(route('beatmaps.discussions.show', $discussion->beatmap_id, $discussion));
        } else {
            return view('beatmaps.discussion-replies.create', compact('discussion', 'reply'));
        }
    }
}
