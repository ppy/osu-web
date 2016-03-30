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
use DB;
use Exception;
use Request;

class DiscussionRepliesController extends Controller
{
    // the beatmap id isn't actually needed in most cases
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);

        return parent::__construct();
    }

    public function store($beatmapId, $beatmapDiscussionId)
    {
        $discussion = BeatmapDiscussion::findOrFail($beatmapDiscussionId);

        if (!$discussion->canBeRepliedBy(Auth::user())) {
            abort(403);
        }

        $params = array_merge(
            get_params(Request::all(), 'beatmap_discussion_reply', [
                'message',
            ]),
            [
                'beatmap_discussion_id' => $discussion->id,
                'user_id' => Auth::user()->user_id,
            ]
        );

        $discussionParams = get_params(Request::all(), 'beatmap_discussion', ['resolved:bool']);

        if (($discussionParams['resolve'] ?? null) === true && !$discussion->canBeUpdatedBy(Auth::user())) {
            abort(403);
        }

        $reply = new BeatmapDiscussionReply($params);
        $discussion->fill($discussionParams);

        try {
            $saved = DB::transaction(function () use ($reply, $discussion) {
                if ($reply->save() === false) {
                    throw new Exception('failed');
                }

                if ($discussion->save() === false) {
                    throw new Exception('failed');
                }

                return true;
            });
        } catch (Exception $_e) {
            $saved = false;
        }

        if ($saved === true) {
            return $reply->beatmapDiscussion->beatmapsetDiscussion->defaultJson(Auth::user());
        } else {
            return error_popup(trans('beatmaps.discussion-replies.store.error'));
        }
    }
}
