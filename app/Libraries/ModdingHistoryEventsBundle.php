<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ModdingHistoryEventsBundle
{
    protected $isModerator;
    protected $isKudosuModerator;
    protected $searchParams;

    private $discussions;
    private $events;
    private $params;
    private $posts;
    private $query;
    private $total;
    private $user;
    private $votes;
    private $withExtras = false;

    public static function forProfile(User $user, array $searchParams)
    {
        $searchParams['limit'] = 10;
        $searchParams['sort'] = 'id_desc';

        $obj = static::forListing($user, $searchParams);
        $obj->withExtras = true;

        return $obj;
    }

    public static function forListing(User $user, array $searchParams)
    {
        $obj = new static;
        $obj->user = $user;
        $obj->searchParams = $searchParams;
        $obj->isModerator = priv_check('BeatmapDiscussionModerate')->can();
        $obj->isKudosuModerator = priv_check('BeatmapDiscussionAllowOrDenyKudosu')->can();

        return $obj;
    }

    public function getPaginator()
    {
        if (!isset($this->events)) {
            $this->toArray();
        }

        return new LengthAwarePaginator(
            $this->events,
            $this->total,
            $this->params['limit'],
            $this->params['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $this->params,
            ]
        );
    }

    public function getParams()
    {
        return $this->params;
    }

    public function toArray(): array
    {
        $this->events = $this->getEvents();
        $this->discussions = $this->getDiscussions();
        $this->posts = $this->getPosts();

        if ($this->withExtras) {
            $this->votes = $this->getVotes();
            $kudosu = $this->user->receivedKudosu()->with('post', 'post.topic', 'giver', 'kudosuable')->orderBy('exchange_id', 'desc')->limit(6)->get();
        }

        $users = $this->getUsers();

        $array = [
            'discussions' => json_collection(
                $this->discussions,
                'BeatmapDiscussion',
                ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes']
            ),
            'events' => json_collection(
                $this->events,
                'BeatmapsetEvent',
                ['discussion.starting_post', 'beatmapset.user']
            ),
            'posts' => json_collection(
                $this->posts,
                'BeatmapDiscussionPost',
                ['beatmap_discussion.beatmapset']
            ),
            'users' => json_collection(
                $users,
                'UserCompact',
                ['group_badge']
            ),
        ];

        if (isset($this->votes)) {
            $array['votes'] = $this->votes;
        }

        if (isset($kudosu)) {
            $array['extras'] = [
                'recentlyReceivedKudosu' => json_collection($kudosu, 'KudosuHistory')
            ];
            //only recentlyReceivedKudosu is set, do we even need it?
            $array['perPage'] = [
                'recentlyReceivedKudosu' => 5,
            ];
        }

        if ($this->withExtras) {
            $array['user'] = json_item(
                $this->user,
                'User',
                [
                    "statistics:mode({$this->user->playmode})",
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
            );
        }

        return $array;
    }

    private function getDiscussions()
    {
        $includes = [
            'beatmap',
            'beatmapDiscussionVotes',
            'beatmapset',
            'startingPost',
        ];

        $parents = BeatmapDiscussion::search($this->searchParams);
        $parents['query']->with($includes);

        if ($this->isModerator) {
            $parents['query']->visibleWithTrashed();
        } else {
            $parents['query']->visible();
        }

        $discussions = $parents['query']->get();

        // TODO: remove this when reviews are released
        if (!config('osu.beatmapset.discussion_review_enabled')) {
            return $discussions;
        }

        $children = BeatmapDiscussion::whereIn('parent_id', $discussions->pluck('id'))->with($includes);

        if ($this->isModerator) {
            $children->visibleWithTrashed();
        } else {
            $children->visible();
        }

        return $discussions->merge($children->get());
    }

    private function getEvents()
    {
        $events = BeatmapsetEvent::search($this->searchParams);
        unset($events['params']['user']);
        $events['query'] = $events['query']->with([
            'beatmapset',
            'beatmapDiscussion.beatmapset',
            'beatmapDiscussion.startingPost',
        ])->whereHas('beatmapset');

        if ($this->isModerator) {
            $events['query']->with(['beatmapset' => function ($query) {
                $query->withTrashed();
            }]);
        }

        // just for the paginator
        $this->total = $events['query']->realCount();
        $this->params = $events['params'];

        return $events['query']->get();
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

        return $posts['query']->get();
    }

    private function getUsers()
    {
        $userIds = [];
        foreach ($this->discussions as $discussion) {
            $userIds[] = $discussion->user_id;
            $userIds[] = $discussion->startingPost->last_editor_id;
        }

        $votesGiven = ($this->votes['given'] ?? collect())->pluck('user_id')->toArray();
        $votesReceived = ($this->votes['received'] ?? collect())->pluck('user_id')->toArray();

        $userIds = array_merge(
            $userIds,
            $this->posts->pluck('user_id')->toArray(),
            $this->posts->pluck('last_editor_id')->toArray(),
            $this->events->pluck('user_id')->toArray(),
            $votesGiven,
            $votesReceived
        );

        $userIds = array_values(array_filter(array_unique($userIds)));

        return User::whereIn('user_id', $userIds)
            ->with('userGroups')
            ->default()
            ->get();
    }

    private function getVotes()
    {
        return [
            'given' => BeatmapDiscussionVote::recentlyGivenByUser($this->user->getKey()),
            'received' => BeatmapDiscussionVote::recentlyReceivedByUser($this->user->getKey()),
        ];
    }
}
