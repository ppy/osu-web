<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use App\Models\Notification;
use Auth;
use DB;
use Illuminate\Pagination\Paginator;
use Request;

class BeatmapDiscussionPostsController extends Controller
{
    protected $section = 'beatmaps';

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);

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
        $isModerator = priv_check('BeatmapDiscussionModerate')->can();
        $params = request();
        $params['is_moderator'] = $isModerator;

        if (!$isModerator) {
            $params['with_deleted'] = false;
        }

        $search = BeatmapDiscussionPost::search($params);

        $query = $search['query']->with([
            'user',
            'beatmapset',
            'beatmapDiscussion',
            'beatmapDiscussion.beatmapset',
            'beatmapDiscussion.user',
            'beatmapDiscussion.startingPost',
        ])->limit($search['params']['limit'] + 1);

        $posts = new Paginator(
            $query->get(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        return ext_view('beatmap_discussion_posts.index', compact('posts'));
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
        $discussion = $this->prepareDiscussion(request());

        $newDiscussion = !$discussion->exists;

        if ($newDiscussion) {
            priv_check('BeatmapDiscussionStore', $discussion)->ensureCan();
        }

        $postParams = get_params(request(), 'beatmap_discussion_post', ['message']);
        $postParams['user_id'] = Auth::user()->user_id;
        $post = new BeatmapDiscussionPost($postParams);
        $post->beatmapDiscussion()->associate($discussion);

        priv_check('BeatmapDiscussionPostStore', $post)->ensureCan();

        $posts = [$post];
        $events = [];

        $resetNominations = false;
        $disqualify = false;

        if ($newDiscussion && $discussion->message_type === 'problem') {
            $resetNominations = $discussion->beatmapset->isPending() &&
                $discussion->beatmapset->hasNominations() &&
                priv_check('BeatmapsetResetNominations', $discussion->beatmapset)->can();

            if ($resetNominations) {
                $events[] = BeatmapsetEvent::NOMINATION_RESET;
            } else {
                $disqualify = priv_check('BeatmapsetDisqualify', $discussion->beatmapset)->can();
            }
        }

        $reopen = false;

        if (!$newDiscussion && $discussion->isDirty('resolved')) {
            if ($discussion->resolved) {
                priv_check('BeatmapDiscussionResolve', $discussion)->ensureCan();
                $events[] = BeatmapsetEvent::ISSUE_RESOLVE;
            } else {
                priv_check('BeatmapDiscussionReopen', $discussion)->ensureCan();
                $events[] = BeatmapsetEvent::ISSUE_REOPEN;
                $reopen = true;
            }

            $posts[] = BeatmapDiscussionPost::generateLogResolveChange(Auth::user(), $discussion->resolved);
        }

        $notifyQualifiedProblem = false;

        if ($discussion->beatmapset->isQualified() && $discussion->message_type === 'problem') {
            $openProblems = $discussion
                ->beatmapset
                ->beatmapDiscussions()
                ->withoutTrashed()
                ->ofType('problem')
                ->where(['resolved' => false])
                ->count();

            $notifyQualifiedProblem = $openProblems === 0 && ($newDiscussion || $reopen);
        }

        try {
            DB::transaction(function () use ($posts, $discussion, $events, $resetNominations, $disqualify) {
                $discussion->saveOrExplode();

                foreach ($posts as $post) {
                    // done here since discussion may or may not previously exist
                    $post->beatmap_discussion_id = $discussion->id;
                    $post->saveOrExplode();
                }

                foreach ($events as $event) {
                    BeatmapsetEvent::log($event, Auth::user(), $posts[0])->saveOrExplode();
                }

                if ($disqualify) {
                    $discussion->beatmapset->disqualify(Auth::user(), $posts[0]);
                }

                if ($resetNominations) {
                    broadcast_notification(Notification::BEATMAPSET_RESET_NOMINATIONS, $discussion->beatmapset, Auth::user());
                }

                // feels like a controller shouldn't be calling refreshCache on a model?
                if ($resetNominations || $disqualify) {
                    $discussion->beatmapset->refreshCache();
                }
            });
        } catch (ModelNotSavedException $_e) {
            return error_popup(trans('beatmaps.discussion-posts.store.error'));
        }

        $beatmapset = $discussion->beatmapset;

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

        if ($notifyQualifiedProblem) {
            // TODO: should work out how have the new post notification be able to handle this instead.
            broadcast_notification(
                Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
                $post,
                auth()->user()
            );
        }

        broadcast_notification(Notification::BEATMAPSET_DISCUSSION_POST_NEW, $post, Auth::user());
        (new NotifyBeatmapsetUpdate([
            'user' => Auth::user(),
            'beatmapset' => $beatmapset,
        ]))->delayedDispatch();

        return [
            'beatmapset' => $beatmapset->defaultDiscussionJson(),
            'beatmap_discussion_post_ids' => array_pluck($posts, 'id'),
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

    private function prepareDiscussion($request)
    {
        $discussionId = get_int($request['beatmap_discussion_id']);

        if ($discussionId === null) {
            $beatmapset = Beatmapset
                ::where('discussion_enabled', true)
                ->findOrFail($request['beatmapset_id']);

            $discussion = new BeatmapDiscussion([
                'beatmapset_id' => $beatmapset->getKey(),
                'user_id' => Auth::user()->getKey(),
                'resolved' => false,
            ]);

            $discussionFilters = [
                'beatmap_id:int',
                'message_type',
                'timestamp:int',
            ];
        } else {
            $discussion = BeatmapDiscussion::findOrFail($discussionId);
            $discussionFilters = ['resolved:bool'];
        }

        $discussionParams = get_params($request, 'beatmap_discussion', $discussionFilters);
        $discussion->fill($discussionParams);

        return $discussion;
    }
}
