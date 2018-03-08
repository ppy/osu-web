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
use App\Jobs\NotifyBeatmapsetUpdate;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetWatch;
use Auth;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
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

        try {
            $post->softDeleteOrExplode(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $post->beatmapset->defaultDiscussionJson();
    }

    public function index()
    {
        priv_check('BeatmapDiscussionModerate')->ensureCan();

        $search = BeatmapDiscussionPost::search(request());
        $posts = new LengthAwarePaginator(
            $search['query']->with([
                    'user',
                    'beatmapset',
                    'beatmapDiscussion',
                    'beatmapDiscussion.beatmapset',
                    'beatmapDiscussion.user',
                    'beatmapDiscussion.startingPost',
                ])->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => route('beatmap-discussion-posts.index'),
                'query' => $search['params'],
            ]
        );

        return view('beatmap_discussion_posts.index', compact('posts'));
    }

    public function restore($id)
    {
        $post = BeatmapDiscussionPost::whereNotNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionPostRestore', $post)->ensureCan();

        $post->restore(Auth::user());

        return $post->beatmapset->defaultDiscussionJson();
    }

    public function store()
    {
        $discussion = BeatmapDiscussion::findOrNew(Request::input('beatmap_discussion_id'));
        $beatmapset = null;

        if ($discussion->exists) {
            $discussionFilters = ['resolved:bool'];
        } else {
            $beatmapset = Beatmapset
                ::where('discussion_enabled', true)
                ->findOrFail(Request::input('beatmapset_id'));

            $discussion->beatmapset_id = $beatmapset->getKey();
            $discussion->user_id = Auth::user()->user_id;
            $discussion->resolved = false;
            $discussionFilters = [
                'beatmap_id:int',
                'message_type',
                'timestamp:int',
            ];
        }

        $discussionParams = get_params(Request::all(), 'beatmap_discussion', $discussionFilters);
        $discussion->fill($discussionParams);

        priv_check('BeatmapDiscussionPostStore', $discussion)->ensureCan();

        $postParams = get_params(request(), 'beatmap_discussion_post', ['message']);
        $postParams['user_id'] = Auth::user()->user_id;
        $posts = [new BeatmapDiscussionPost($postParams)];
        $events = [];

        $resetNominations = !$discussion->exists &&
            $beatmapset->isPending() &&
            $beatmapset->hasNominations() &&
            $discussion->message_type === 'problem' &&
            priv_check('BeatmapsetResetNominations', $beatmapset)->can();

        if ($resetNominations) {
            $events[] = BeatmapsetEvent::NOMINATION_RESET;
        }

        if ($discussion->exists && $discussion->isDirty('resolved')) {
            priv_check('BeatmapDiscussionResolve', $discussion)->ensureCan();
            $posts[] = BeatmapDiscussionPost::generateLogResolveChange(Auth::user(), $discussion->resolved);
            $events[] = $discussion->resolved ? BeatmapsetEvent::ISSUE_RESOLVE : BeatmapsetEvent::ISSUE_REOPEN;
        }

        try {
            DB::transaction(function () use ($posts, $discussion, $events, $resetNominations) {
                $discussion->saveOrExplode();

                foreach ($posts as $post) {
                    // done here since discussion may or may not previously exist
                    $post->beatmap_discussion_id = $discussion->id;
                    $post->saveOrExplode();
                }

                foreach ($events as $event) {
                    BeatmapsetEvent::log($event, Auth::user(), $posts[0])->saveOrExplode();
                }

                // feels like a controller shouldn't be calling refreshCache on a model?
                if ($resetNominations) {
                    $discussion->beatmapset->refreshCache();
                }
            });
        } catch (ModelNotSavedException $_e) {
            return error_popup(trans('beatmaps.discussion-posts.store.error'));
        }

        $postIds = array_pluck($posts, 'id');
        $beatmapset = $discussion->beatmapset;

        BeatmapsetWatch::markRead($beatmapset, Auth::user());
        NotifyBeatmapsetUpdate::dispatch([
            'user' => Auth::user(),
            'beatmapset' => $beatmapset,
        ]);

        return [
            'beatmapset' => $posts[0]->beatmapset->defaultDiscussionJson(),
            'beatmap_discussion_post_ids' => $postIds,
            'beatmap_discussion_id' => $discussion->id,
        ];
    }

    public function update($id)
    {
        $post = BeatmapDiscussionPost::findOrFail($id);

        priv_check('BeatmapDiscussionPostEdit', $post)->ensureCan();

        $params = get_params(request(), 'beatmap_discussion_post', ['message']);
        $params['last_editor_id'] = Auth::user()->user_id;
        if ($post->update($params)) {
            return $post->beatmapset->defaultDiscussionJson();
        } else {
            $message = trim(implode(' ', [
                $post->validationErrors()->toSentence(),
                $post->beatmapDiscussion->validationErrors()->toSentence(),
            ]));

            return error_popup(presence($message, trans('beatmaps.discussion-posts.store.error')));
        }
    }
}
