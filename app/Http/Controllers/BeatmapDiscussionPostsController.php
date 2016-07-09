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
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapsetDiscussion;
use DB;
use Exception;
use Request;

class BeatmapDiscussionPostsController extends Controller
{
    protected $section = 'beatmaps';

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

        $posts = [new BeatmapDiscussionPost($this->postParams($discussion))];
        $previousDiscussionResolved = $discussion->resolved;
        $discussion->fill($this->discussionParams($isNewDiscussion));

        priv_check('BeatmapDiscussionPost', $discussion)->ensureCan();

        if ($discussion->resolved === true) {
            priv_check('BeatmapDiscussionResolve', $discussion)->ensureCan();
        }

        if (!$isNewDiscussion && ($discussion->resolved !== $previousDiscussionResolved)) {
            $posts[] = BeatmapDiscussionPost::generateLogResolveChange(Auth::user(), $discussion->resolved);
        }

        try {
            $saved = DB::transaction(function () use ($posts, $discussion) {
                if ($discussion->save() === false) {
                    throw new Exception('failed');
                }

                foreach ($posts as $post) {
                    // done here since discussion may or may not previously exist
                    $post->beatmap_discussion_id = $discussion->id;

                    if ($post->save() === false) {
                        throw new Exception('failed');
                    }
                }

                return true;
            });
        } catch (Exception $_e) {
            $saved = false;
        }

        $postIds = array_map(function ($post) {
            return $post->id;
        }, $posts);

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

        $post->update($this->postParams($post->beatmapDiscussion, false));

        return [
            'beatmapset_discussion' => $post->beatmapsetDiscussion->defaultJson(),
        ];
    }

    private function discussionParams($isNew)
    {
        $filters = ['resolved:bool'];

        if ($isNew) {
            $filters[] = 'beatmap_id:int';
            $filters[] = 'message_type';
            $filters[] = 'timestamp:int';
        }

        $params = get_params(Request::all(), 'beatmap_discussion', $filters);
        $params['resolved'] = $params['resolved'] ?? false;

        if ($isNew) {
            $params['user_id'] = Auth::user()->user_id;
        }

        return $params;
    }

    private function postParams($discussion, $isNew = true)
    {
        $params = get_params(Request::all(), 'beatmap_discussion_post', ['message']);
        $params['beatmap_discussion_id'] = $discussion->id;
        $params['last_editor_id'] = Auth::user()->user_id;

        if ($isNew) {
            $params['user_id'] = Auth::user()->user_id;
        }

        return $params;
    }
}
