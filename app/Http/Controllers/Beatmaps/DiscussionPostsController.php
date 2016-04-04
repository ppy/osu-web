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
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapsetDiscussion;
use DB;
use Exception;
use Request;

class DiscussionPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function store()
    {
        $discussion = BeatmapDiscussion::findOrNew(Request::input('beatmap_discussion_id'));
        $isNewDiscussion = ($discussion->id === null);

        if ($isNewDiscussion) {
            $beatmapsetDiscussion = BeatmapsetDiscussion
                ::where('beatmapset_id', Request::input('beatmapset_id'))
                ->firstOrFail();

            $discussion->beatmapset_discussion_id = $beatmapsetDiscussion->id;
        }

        $post = new BeatmapDiscussionPost($this->postParams($discussion));
        $discussion->fill($this->discussionParams($isNewDiscussion));

        if (!$discussion->canBePostedBy(Auth::user())) {
            abort(403);
        }

        if ($discussion->resolved === true && !$discussion->canBeResolvedBy(Auth::user())) {
            abort(403);
        }

        try {
            $saved = DB::transaction(function () use ($post, $discussion, $isNewDiscussion) {
                if ($discussion->save() === false) {
                    throw new Exception('failed');
                }

                if ($isNewDiscussion) {
                    $post->beatmap_discussion_id = $discussion->id;
                }

                if ($post->save() === false) {
                    throw new Exception('failed');
                }

                return true;
            });
        } catch (Exception $_e) {
            $saved = false;
        }

        if ($saved === true) {
            return [
                'beatmapset_discussion' => $post->beatmapsetDiscussion->defaultJson(Auth::user()),
                'beatmap_discussion_post_id' => $post->id,
                'beatmap_discussion_id' => $discussion->id,
            ];
        } else {
            return error_popup(trans('beatmaps.discussion-posts.store.error'));
        }
    }

    private function discussionParams($isNew)
    {
        $filters = ['resolved:bool'];

        if ($isNew) {
            $filters = array_merge($filters, [
                'beatmap_id:int',
                'message_type',
                'timestamp:int',
            ]);
        }

        return array_merge(
            get_params(Request::all(), 'beatmap_discussion', $filters),
            [
                'user_id' => Auth::user()->user_id,
            ]
        );
    }

    private function postParams($discussion)
    {
        return array_merge(
            get_params(Request::all(), 'beatmap_discussion_post', [
                'message',
            ]),
            [
                'beatmap_discussion_id' => $discussion->id,
                'user_id' => Auth::user()->user_id,
            ]
        );
    }
}
