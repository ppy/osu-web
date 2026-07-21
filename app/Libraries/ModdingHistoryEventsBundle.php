<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Libraries\BeatmapsetDiscussion\Review;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use App\Traits\Memoizes;
use App\Transformers\BeatmapDiscussionPostTransformer;
use App\Transformers\BeatmapDiscussionTransformer;
use App\Transformers\BeatmapsetEventTransformer;
use App\Transformers\BeatmapsetTransformer;
use App\Transformers\BeatmapTransformer;
use App\Transformers\KudosuHistoryTransformer;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserTransformer;
use Ds\Set;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Pagination\LengthAwarePaginator;

class ModdingHistoryEventsBundle
{
    use Memoizes;

    const KUDOSU_PER_PAGE = 5;

    protected array $extraParams;
    protected bool $isModerator;
    protected array $searchParams;

    private $params;
    private $total;
    private $user;
    private $withExtras = false; // TODO: change to includes list instead.

    public static function forProfile(User $user, array $searchParams, array $extraParams)
    {
        $searchParams['limit'] = 10;
        $searchParams['sort'] = 'id_desc';

        $obj = static::forListing($user, $searchParams, $extraParams);
        $obj->withExtras = true;

        return $obj;
    }

    public static function forListing(?User $user, array $searchParams, array $extraParams)
    {
        $obj = new static();
        $obj->user = $user;
        $obj->searchParams = $searchParams;

        $obj->extraParams = [
            'is_kudosu_moderator' => priv_check('BeatmapDiscussionAllowOrDenyKudosu')->can(),
            'is_moderator' => priv_check('BeatmapDiscussionModerate')->can(),
        ];

        $obj->isModerator = $obj->extraParams['is_moderator'];

        return $obj;
    }

    public function getPaginator()
    {
        $events = $this->getEvents();
        $params = $this->params;

        return new LengthAwarePaginator(
            $events,
            $this->total, // set in getEvents()
            $params['limit'],
            $params['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $params,
            ]
        );
    }

    public function getParams()
    {
        return $this->params;
    }

    public function toArray(): array
    {
        return $this->memoize(__FUNCTION__, function () {
            $array = [
                'events' => json_collection(
                    $this->getEvents(),
                    new BeatmapsetEventTransformer(),
                    ['discussion.starting_post', 'beatmapset.user']
                ),
                'reviewsConfig' => Review::config(),
                'users' => json_collection(
                    $this->getUsers(),
                    new UserCompactTransformer(),
                    ['groups']
                ),
            ];

            if ($this->withExtras) {
                $array['beatmaps'] = json_collection(
                    $this->getBeatmaps(),
                    new BeatmapTransformer()
                );

                $array['beatmapsets'] = json_collection(
                    $this->getBeatmapsets(),
                    new BeatmapsetTransformer()
                );

                $array['discussions'] = json_collection(
                    $this->getDiscussions(),
                    new BeatmapDiscussionTransformer(),
                    ['starting_post', 'current_user_attributes']
                );

                $array['posts'] = json_collection(
                    $this->getPosts(),
                    new BeatmapDiscussionPostTransformer(),
                    // TODO: should get beatmapset from top level beatmapset key instead of embedded property.
                    ['beatmap_discussion.beatmapset.availability']
                );

                $array['votes'] = $this->getVotes();

                if ($this->user !== null) {
                    $kudosu = $this->user
                        ->receivedKudosu()
                        ->with('post', 'post.topic', 'giver')
                        ->with(['kudosuable' => function (MorphTo $morphTo) {
                            $morphTo->morphWith([BeatmapDiscussion::class => ['beatmap', 'beatmapset']]);
                        }])
                        ->orderBy('exchange_id', 'desc')
                        ->limit(static::KUDOSU_PER_PAGE + 1)
                        ->get();

                    $array['extras'] = [
                        'recentlyReceivedKudosu' => json_collection($kudosu, new KudosuHistoryTransformer()),
                    ];
                    // only recentlyReceivedKudosu is set, do we even need it?
                    // every other item has a show more link that goes to a listing.
                    $array['perPage'] = [
                        'recentlyReceivedKudosu' => static::KUDOSU_PER_PAGE,
                    ];

                    $array['user'] = json_item(
                        $this->user,
                        (new UserTransformer())->setMode($this->user->playmode),
                        [
                            ...UserTransformer::PROFILE_HEADER_INCLUDES,
                            'graveyard_beatmapset_count',
                            'loved_beatmapset_count',
                            'pending_beatmapset_count',
                            'ranked_beatmapset_count',
                            'statistics',
                            'statistics.country_rank',
                            'statistics.rank',
                        ]
                    );
                }
            }

            return $array;
        });
    }

    private function getBeatmaps()
    {
        return $this->memoize(__FUNCTION__, function () {
            if (!$this->withExtras) {
                return collect();
            }

            $beatmapsetId = $this->getBeatmapsets()
                ->pluck('beatmapset_id');

            return Beatmap::whereIn('beatmapset_id', $beatmapsetId)->get();
        });
    }

    private function getBeatmapsets()
    {
        return $this->memoize(__FUNCTION__, function () {
            if (!$this->withExtras) {
                return collect();
            }

            $beatmapsetId = $this->getDiscussions()
                ->pluck('beatmapset_id')
                ->unique()
                ->toArray();

            return Beatmapset::whereIn('beatmapset_id', $beatmapsetId)->get();
        });
    }

    private function getDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            static $includes = [
                'beatmap',
                'beatmapDiscussionVotes',
                'beatmapset',
                'startingPost',
            ];

            if (!$this->withExtras) {
                return collect();
            }

            $parents = BeatmapDiscussion::search($this->searchParams, $this->extraParams);
            $parents['query']->with($includes);

            if ($this->isModerator) {
                $parents['query']->visibleWithTrashed();
            } else {
                $parents['query']->visible();
            }

            $discussions = $parents['query']->get();

            $children = BeatmapDiscussion::whereIn('parent_id', $discussions->pluck('id'))->with($includes);

            if ($this->isModerator) {
                $children->visibleWithTrashed();
            } else {
                $children->visible();
            }

            return $discussions->merge($children->get());
        });
    }

    private function getEvents()
    {
        return $this->memoize(__FUNCTION__, function () {
            $events = BeatmapsetEvent::search($this->searchParams, $this->extraParams);
            // beatmapset has global scopes with deleted_at and active but these are not indexed,
            // which makes whereHas('beatmapset') unusable.
            $events['query'] = $events['query']->with([
                'beatmapset.user',
                'beatmapDiscussion.beatmapset',
                'beatmapDiscussion.startingPost',
            ]);

            if ($this->isModerator) {
                $events['query']->with(['beatmapset' => function ($query) {
                    $query->withTrashed();
                }]);
            }

            // just for the paginator
            $this->total = $events['query']->realCount();
            $this->params = $events['params'];

            return $events['query']->get();
        });
    }

    private function getPosts()
    {
        return $this->memoize(__FUNCTION__, function () {
            if (!$this->withExtras) {
                return collect();
            }

            $posts = BeatmapDiscussionPost::search($this->searchParams, $this->extraParams);
            $posts['query']->with([
                'beatmapDiscussion.beatmap',
                'beatmapDiscussion.beatmapset',
            ]);

            if (!$this->isModerator) {
                $posts['query']->visible();
            }

            return $posts['query']->get();
        });
    }

    private function getUsers()
    {
        return $this->memoize(__FUNCTION__, function () {
            $discussions = $this->getDiscussions();
            $events = $this->getEvents();
            $posts = $this->getPosts();
            $votes = $this->getVotes();

            $userIds = new Set();
            foreach ($discussions as $discussion) {
                $userIds->add(
                    $discussion->user_id,
                    $discussion->startingPost->last_editor_id
                );
            }

            $userIds->add(
                ...$posts->pluck('user_id'),
                ...$posts->pluck('last_editor_id'),
                ...$events->pluck('user_id'),
                ...$events->pluck('beatmapDiscussion')->pluck('user_id'),
                ...$votes['given']->pluck('user_id'),
                ...$votes['received']->pluck('user_id')
            );

            if ($this->user !== null) {
                // Always add current user to the result array (assuming no need to do too many additional preloads).
                // This prevents them from potentially get removed by the `default` scope.
                $userIds->remove($this->user->getKey());
            }

            $users = User::whereIn('user_id', $userIds->toArray())->with('userGroups');
            if (!$this->isModerator) {
                $users->default();
            }

            $users = $users->get();
            if ($this->user !== null) {
                $users->push($this->user);
            }

            return $users;
        });
    }

    private function getVotes()
    {
        return $this->memoize(__FUNCTION__, function () {
            if ($this->withExtras && $this->user !== null) {
                return [
                    'given' => BeatmapDiscussionVote::recentlyGivenByUser($this->user->getKey()),
                    'received' => BeatmapDiscussionVote::recentlyReceivedByUser($this->user->getKey()),
                ];
            } else {
                return [
                    'given' => collect(),
                    'received' => collect(),
                ];
            }
        });
    }
}
