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

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ModdingHistoryController extends Controller
{
    protected $actionPrefix = 'modding-history-';
    protected $section = 'user';

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
            $this->user = User::lookupWithHistory($userId, null, $this->isModerator, true);

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

        $this->searchParams['limit'] = 10;
        $this->searchParams['sort'] = 'id_desc';

        $discussions = BeatmapDiscussion::search($this->searchParams);
        $discussions['query']->with([
            'beatmap',
            'beatmapDiscussionVotes',
            'beatmapset',
            'startingPost',
        ]);

        if ($this->isModerator) {
            $discussions['query']->visibleWithTrashed();
        } else {
            $discussions['query']->visible();
        }

        $discussions['items'] = $discussions['query']->get();

        // TODO: remove this when reviews are released
        if (config('osu.beatmapset.discussion_review_enabled')) {
            $children = BeatmapDiscussion::whereIn('parent_id', $discussions['items']->pluck('id'))
                ->with([
                    'beatmap',
                    'beatmapDiscussionVotes',
                    'beatmapset',
                    'startingPost',
                ]);

            if ($this->isModerator) {
                $children->visibleWithTrashed();
            } else {
                $children->visible();
            }

            $discussions['items'] = $discussions['items']->merge($children->get());
        }

        $posts = BeatmapDiscussionPost::search($this->searchParams);
        $posts['query']->with([
            'beatmapDiscussion.beatmap',
            'beatmapDiscussion.beatmapset',
        ]);

        if (!$this->isModerator) {
            $posts['query']->visible();
        }

        $posts['items'] = $posts['query']->get();

        $events = BeatmapsetEvent::search($this->searchParams);
        $events['items'] = $events['query']->with([
            'beatmapset',
            'beatmapDiscussion.beatmapset',
            'beatmapDiscussion.startingPost',
        ])->whereHas('beatmapset')->get();

        $votes['items'] = BeatmapDiscussionVote::recentlyGivenByUser($user->getKey());
        $receivedVotes['items'] = BeatmapDiscussionVote::recentlyReceivedByUser($user->getKey());

        $discussionUserIds = [];
        foreach ($discussions['items'] as $discussion) {
            $discussionUserIds[] = $discussion->user_id;
            $discussionUserIds[] = $discussion->startingPost->last_editor_id;
        }

        $userIdSources = [
            $discussionUserIds,
            $posts['items']
                ->pluck('user_id')
                ->toArray(),
            $posts['items']
                ->pluck('last_editor_id')
                ->toArray(),
            $events['items']
                ->pluck('user_id')
                ->toArray(),
            $votes['items']
                ->pluck('user_id')
                ->toArray(),
            $receivedVotes['items']
                ->pluck('user_id')
                ->toArray(),
        ];

        $userIds = [];

        foreach ($userIdSources as $source) {
            $userIds = array_merge($userIds, $source);
        }

        $userIds = array_values(array_filter(array_unique($userIds)));

        $users = User::whereIn('user_id', $userIds)
            ->with('userGroups')
            ->default()
            ->get();

        $perPage = [
            'recentlyReceivedKudosu' => 5,
        ];

        $extras = [];

        foreach ($perPage as $page => $n) {
            // Fetch perPage + 1 so the frontend can tell if there are more items
            // by comparing items count and perPage number.
            $extras[$page] = $this->getExtra($user, $page, $n + 1);
        }

        $jsonChunks = [
            'extras' => $extras,
            'perPage' => $perPage,
            'user' => json_item(
                $user,
                'User',
                [
                    "statistics:mode({$user->playmode})",
                    'active_tournament_banner',
                    'badges',
                    'follower_count',
                    'graveyard_beatmapset_count',
                    'group_badge',
                    'loved_beatmapset_count',
                    'previous_usernames',
                    'ranked_and_approved_beatmapset_count',
                    'statistics.rank',
                    'support_level',
                    'unranked_beatmapset_count',
                ]
            ),
            'discussions' => json_collection(
                $discussions['items'],
                'BeatmapDiscussion',
                ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes']
            ),
            'events' => json_collection(
                $events['items'],
                'BeatmapsetEvent',
                ['discussion.starting_post', 'beatmapset.user']
            ),
            'posts' => json_collection(
                $posts['items'],
                'BeatmapDiscussionPost',
                ['beatmap_discussion.beatmapset']
            ),
            'votes' => [
                'given' => $votes['items'],
                'received' => $receivedVotes['items'],
            ],
            'users' => json_collection(
                $users,
                'UserCompact',
                ['group_badge']
            ),
        ];

        return ext_view('users.beatmapset_activities', compact(
            'jsonChunks',
            'user'
        ));
    }

    public function events()
    {
        $user = $this->user;

        $search = BeatmapsetEvent::search($this->searchParams);
        unset($search['params']['user']);
        if ($this->isModerator) {
            $items = $search['query']->with('user')->with(['beatmapset' => function ($query) {
                $query->withTrashed();
            }])->with('beatmapset.user')->get();
        } else {
            $items = $search['query']->with(['user', 'beatmapset', 'beatmapset.user'])->get();
        }

        $events = new LengthAwarePaginator(
            $items,
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        $showUserSearch = false;

        return ext_view('beatmapset_events.index', compact('events', 'user', 'search', 'showUserSearch'));
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

    private function getExtra($user, $page, $options, $perPage = 10, $offset = 0)
    {
        // Grouped by $transformer and sorted alphabetically ($transformer and then $page).
        switch ($page) {
            // KudosuHistory
            case 'recentlyReceivedKudosu':
                $transformer = 'KudosuHistory';
                $query = $user->receivedKudosu()
                    ->with('post', 'post.topic', 'giver', 'kudosuable')
                    ->orderBy('exchange_id', 'desc');
                break;
        }

        if (!isset($collection)) {
            $collection = $query->limit($perPage)->offset($offset)->get();
        }

        return json_collection($collection, $transformer, $includes ?? []);
    }
}
