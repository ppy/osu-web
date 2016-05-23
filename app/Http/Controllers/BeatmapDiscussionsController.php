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
namespace App\Http\Controllers;

use Auth;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapsetDiscussion;
use Request;

class BeatmapDiscussionsController extends Controller
{
    protected $section = 'beatmaps';

    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function vote($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);

        authz('BeatmapDiscussionVote', $discussion)->ensureCan();

        $params = get_params(Request::all(), 'beatmap_discussion_vote',
            ['score:int'],
            [],
            [
                'beatmap_discussion_id' => $discussion->id,
                'user_id' => Auth::user()->user_id,
            ]
        );

        $vote = $discussion->beatmapDiscussionVotes()->where(['user_id' => Auth::user()->user_id])->firstOrNew([]);
        $vote->fill($params);

        if (($params['score'] ?? null) === 0) {
            if ($vote->id === null) {
                // no existing vote and setting to 0 is noop
                $result = true;
            } else {
                $result = $vote->delete();
            }
        } else {
            $result = $vote->save();
        }

        if ($result === true) {
            return $discussion->beatmapsetDiscussion->defaultJson(Auth::user());
        } else {
            return error_popup(trans('beatmaps.discussion-votes.update.error'));
        }
    }
}
