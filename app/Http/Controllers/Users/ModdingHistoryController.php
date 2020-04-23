<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

        $discussions = $this->getDiscussions();
        $discussions = $this->getDiscussionsWithReviews($discussions);

        $posts = $this->getPosts();

        $events = $this->getEvents();

        $votes['items'] = BeatmapDiscussionVote::recentlyGivenByUser($user->getKey());
        $receivedVotes['items'] = BeatmapDiscussionVote::recentlyReceivedByUser($user->getKey());

        $users = $this->getUsers($discussions, $posts, $events, $votes, $receivedVotes);

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

        $search = $events = $this->getEvents();
        $discussions = $this->getDiscussions();
        $discussions = $this->getDiscussionsWithReviews($discussions);
        // Posts
        $posts = $this->getPosts();

        // Users
        $users = $this->getUsers($discussions, $posts, $events);

        $paginator = new LengthAwarePaginator(
            $events,
            $events['query']->realCount(),
            $events['params']['limit'],
            $events['params']['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $events['params'],
            ]
        );

        $showUserSearch = false;

        $jsonChunks = [
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
            'users' => json_collection(
                $users,
                'UserCompact',
                ['group_badge']
            ),
        ];

        return ext_view('beatmapset_events.index', compact('events', 'paginator', 'jsonChunks', 'user', 'search', 'showUserSearch'));
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

    private function getDiscussions()
    {
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

        return $discussions;
    }

    private function getDiscussionsWithReviews($discussions)
    {
        // TODO: remove this when reviews are released
        if (!config('osu.beatmapset.discussion_review_enabled')) {
            return $discussions;
        }

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

        return $discussions;
    }


    private function getEvents()
    {
        $events = BeatmapsetEvent::search($this->searchParams);
        unset($events['params']['user']);
        $events['query'] = $events['query']->with([
            'beatmapset',
            'beatmapDiscussion.beatmapset',
            'beatmapDiscussion.startingPost',
        ]);

        if ($this->isModerator) {
            $events['query']->with(['beatmapset' => function ($query) {
                $query->withTrashed();
            }]);
        }

        $events['items'] = $events['query']->whereHas('beatmapset')->get();

        return $events;
    }

    private function getPosts()
    {
        $posts = BeatmapDiscussionPost::search($this->searchParams);
        $posts['query']->with([
            'beatmapDiscussion.beatmap',
            'beatmapDiscussion.beatmapset',
        ]);

        if (!$this->isModerator) {
            $posts['query']->visible();
        }

        $posts['items'] = $posts['query']->get();

        return $posts;
    }

    private function getUsers($discussions, $posts, $events, $votesGiven = null, $votesReceived = null)
    {
        $userIds = [];
        foreach ($discussions['items'] as $discussion) {
            $userIds[] = $discussion->user_id;
            $userIds[] = $discussion->startingPost->last_editor_id;
        }

        $userIds = array_merge(
            $userIds,
            $posts['items']->pluck('user_id')->toArray(),
            $posts['items']->pluck('last_editor_id')->toArray(),
            $events['items']->pluck('user_id')->toArray(),
            ($votesGiven['items'] ?? collect())->pluck('user_id')->toArray(),
            ($votesReceived['items'] ?? collect())->pluck('user_id')->toArray()
        );

        $userIds = array_values(array_filter(array_unique($userIds)));

        $users = User::whereIn('user_id', $userIds)
            ->with('userGroups')
            ->default()
            ->get();

        return $users;
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
