<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\ModdingHistoryEventsBundle;
use App\Libraries\User\FindForProfilePage;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use Illuminate\Pagination\LengthAwarePaginator;

class ModdingHistoryController extends Controller
{
    protected $searchParams;
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = FindForProfilePage::find($request->route('user'));

            $userId = $this->user->getKey();
            $this->searchParams = array_merge(request()->query(), [
                'current_user_id' => $userId,
                'user' => $userId,
            ]);

            // This bit isn't needed when ModdingHistoryEventsBundle is used.
            $this->searchParams['is_moderator'] = priv_check('BeatmapDiscussionModerate')->can();
            $this->searchParams['is_kudosu_moderator'] = priv_check('BeatmapDiscussionAllowOrDenyKudosu')->can();
            if (!$this->searchParams['is_moderator']) {
                $this->searchParams['with_deleted'] = false;
            }

            return $next($request);
        });

        parent::__construct();
    }

    public function index()
    {
        $user = $this->user;

        $jsonChunks = ModdingHistoryEventsBundle::forProfile($user, $this->searchParams)->toArray();

        return ext_view('users.beatmapset_activities', compact(
            'jsonChunks',
            'user'
        ));
    }

    public function posts()
    {
        $user = $this->user;

        $search = BeatmapDiscussionPost::search($this->searchParams);
        unset($search['params']['user']);
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
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        return ext_view('beatmap_discussion_posts.index', compact('posts', 'user'));
    }

    public function votesGiven()
    {
        $user = $this->user;

        $search = BeatmapDiscussionVote::search($this->searchParams);
        unset($search['params']['user']);
        $votes = new LengthAwarePaginator(
            $search['query']->with([
                'user',
                'beatmapDiscussion',
                'beatmapDiscussion.user',
                'beatmapDiscussion.beatmapset',
                'beatmapDiscussion.startingPost',
            ])->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        return ext_view('beatmapset_discussion_votes.index', compact('votes', 'user'));
    }

    public function votesReceived()
    {
        $user = $this->user;
        // quick workaround for existing call
        $this->searchParams['receiver'] = $user->getKey();
        unset($this->searchParams['user']);

        $search = BeatmapDiscussionVote::search($this->searchParams);
        unset($search['params']['user']);
        $votes = new LengthAwarePaginator(
            $search['query']->with([
                'user',
                'beatmapDiscussion',
                'beatmapDiscussion.user',
                'beatmapDiscussion.beatmapset',
                'beatmapDiscussion.startingPost',
            ])->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        return ext_view('beatmapset_discussion_votes.index', compact('votes', 'user'));
    }
}
