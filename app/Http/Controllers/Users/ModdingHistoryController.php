<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\ModdingHistoryEventsBundle;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ModdingHistoryController extends Controller
{
    protected $isModerator;
    protected $isKudosuModerator;
    protected $searchParams;
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $userId = request()->route('user');
            $this->isModerator = priv_check('BeatmapDiscussionModerate')->can();
            $this->isKudosuModerator = priv_check('BeatmapDiscussionAllowOrDenyKudosu')->can();
            $this->user = User::lookupWithHistory($userId, null, true);

            if ($this->user === null || $this->user->isBot() || !priv_check('UserShow', $this->user)->can()) {
                return ext_view('users.show_not_found', null, null, 404);
            }

            $this->searchParams = array_merge(request()->query(), ['user' => $this->user->user_id]);

            if ((string) $this->user->user_id !== (string) $userId) {
                return ujs_redirect(route(
                    $request->route()->getName(),
                    $this->searchParams
                ));
            }

            // This bit isn't needed when ModdingHistoryEventsBundle is used.
            $this->searchParams['is_moderator'] = $this->isModerator;
            $this->searchParams['is_kudosu_moderator'] = $this->isKudosuModerator;
            if (!$this->isModerator) {
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
