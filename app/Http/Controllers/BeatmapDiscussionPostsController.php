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

use App\Exceptions\ModelNotSavedException;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapsetDiscussion;
use App\Models\BeatmapsetEvent;
use Auth;
use DB;
use Request;

class BeatmapDiscussionPostsController extends Controller
{
    protected $section = 'beatmaps';

    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function destroy($id)
    {
        $post = BeatmapDiscussionPost::whereNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionPostDestroy', $post)->ensureCan();

        $error = $post->softDelete(Auth::user());

        if ($error === null) {
            return $post->beatmapsetDiscussion->defaultJson();
        } else {
            return error_popup($error);
        }
    }

    public function restore($id)
    {
        $post = BeatmapDiscussionPost::whereNotNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionPostRestore', $post)->ensureCan();

        $post->restore(Auth::user());

        return $post->beatmapsetDiscussion->defaultJson();
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

        $previousDiscussionResolved = $discussion->resolved;
        $discussion->fill($this->discussionParams($isNewDiscussion));

        priv_check('BeatmapDiscussionPostStore', $discussion)->ensureCan();

        $posts = [new BeatmapDiscussionPost($this->postParams())];
        $events = [];

        if (!$isNewDiscussion && ($discussion->resolved !== $previousDiscussionResolved)) {
            priv_check('BeatmapDiscussionResolve', $discussion)->ensureCan();
            $posts[] = BeatmapDiscussionPost::generateLogResolveChange(Auth::user(), $discussion->resolved);
            $events[] = BeatmapsetEvent::log(
                $discussion->resolved ? BeatmapsetEvent::ISSUE_RESOLVE : BeatmapsetEvent::ISSUE_REOPEN,
                Auth::user(),
                $discussion
            );
        }

        try {
            $saved = DB::transaction(function () use ($posts, $discussion, $events) {
                $discussion->saveOrExplode();

                foreach ($posts as $post) {
                    // done here since discussion may or may not previously exist
                    $post->beatmap_discussion_id = $discussion->id;
                    $post->saveOrExplode();
                }

                foreach ($events as $event) {
                    $event->saveOrExplode();
                }

                return true;
            });
        } catch (ModelNotSavedException $_e) {
            $saved = false;
        }

        $postIds = array_pluck($posts, 'id');

        if ($saved === true) {
            return [
                'beatmapset_discussion' => $posts[0]->beatmapsetDiscussion->defaultJson(Auth::user()),
                'beatmap_discussion_post_ids' => $postIds,
                'beatmap_discussion_id' => $discussion->id,
            ];
        } else {
            return error_popup(trans('beatmaps.discussion-posts.store.error'));
        }
    }

    public function update($id)
    {
        $post = BeatmapDiscussionPost::findOrFail($id);

        priv_check('BeatmapDiscussionPostEdit', $post)->ensureCan();

        $post->update($this->postParams(false));

        return [
            'beatmapset_discussion' => $post->beatmapsetDiscussion->defaultJson(),
        ];
    }

    private function discussionParams($isNew)
    {
        if ($isNew) {
            $filters = [
                'beatmap_id:int',
                'message_type',
                'timestamp:int',
            ];
        } else {
            $filters = ['resolved:bool'];
        }

        $params = get_params(Request::all(), 'beatmap_discussion', $filters);

        if ($isNew) {
            $params['user_id'] = Auth::user()->user_id;
            $params['resolved'] = false;
        }

        return $params;
    }

    private function postParams($isNew = true)
    {
        $params = get_params(Request::all(), 'beatmap_discussion_post', ['message']);

        if ($isNew) {
            $params['user_id'] = Auth::user()->user_id;
        } else {
            $params['last_editor_id'] = Auth::user()->user_id;
        }

        return $params;
    }
}
