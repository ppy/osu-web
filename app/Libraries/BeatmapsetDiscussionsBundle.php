<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;
use App\Traits\Memoizes;
use App\Transformers\BeatmapDiscussionTransformer;
use App\Transformers\BeatmapTransformer;
use App\Transformers\UserCompactTransformer;
use Illuminate\Pagination\Paginator;

class BeatmapsetDiscussionsBundle
{
    use Memoizes;

    private const DISCUSSION_WITHS = ['beatmap', 'beatmapDiscussionVotes', 'beatmapset', 'startingPost'];

    // private $beatmapset;
    private $isModerator;
    private $paginator;
    private $params;
    private $search;

    public function __construct(?Beatmapset $beatmapset, $params)
    {
        // $this->beatmapset = $beatmapset;
        $this->params = $params;

        $this->isModerator = priv_check('BeatmapDiscussionModerate')->can();
        if (!$this->isModerator) {
            $this->params['with_deleted'] = false;
        }
    }

    public function getPaginator()
    {
        if ($this->paginator === null) {
            $this->getDiscussions();
        }

        return $this->paginator;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getSearch()
    {
        return $this->search;
    }

    public function toArray()
    {
        static $discussionIncludes = ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes'];

        $paginator = $this->getPaginator();
        $cursor = $paginator->hasMorePages() ? [
            // TODO: move to non-offset
            'page' => $paginator->currentPage() + 1,
            'limit' => $paginator->perPage(),
        ] : null;

        return [
            'beatmaps' => json_collection($this->getBeatmaps(), new BeatmapTransformer()),
            'cursor' => $cursor,
            'discussions' => json_collection($this->getDiscussions(), new BeatmapDiscussionTransformer(), $discussionIncludes),
            'included_discussions' => json_collection($this->getRelatedDiscussions(), new BeatmapDiscussionTransformer(), $discussionIncludes),
            'reviews_config' => BeatmapsetDiscussionReview::config(),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer(), ['groups']),
        ];
    }

    private function getBeatmaps()
    {
        return $this->memoize(__FUNCTION__, function () {
            $beatmapsetIds = $this->getDiscussions()->pluck('beatmapset_id')->unique()->values();

            return Beatmap::whereIn('beatmapset_id', $beatmapsetIds)->get();
        });
    }

    private function getDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            $this->search = BeatmapDiscussion::search($this->params);

            $query = $this->search['query']->with(static::DISCUSSION_WITHS)->limit($this->search['params']['limit'] + 1);

            // pop 1 off instead?

            $this->paginator = new Paginator(
                $query->get(),
                $this->search['params']['limit'],
                $this->search['params']['page'],
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'query' => $this->search['params'],
                ]
            );

            return $this->paginator->getCollection();
        });
    }

    private function getRelatedDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            $related = BeatmapDiscussion::whereIn('parent_id', $this->getDiscussions()->pluck('id'))->with(static::DISCUSSION_WITHS);

            if ($this->isModerator) {
                $related->visibleWithTrashed();
            } else {
                $related->visible();
            }

            return $related->get();
        });
    }

    private function getUsers()
    {
        return $this->memoize(__FUNCTION__, function () {
            $discussions = $this->getDiscussions();

            $allDiscussions = $discussions->merge($this->getRelatedDiscussions($discussions));
            $userIds = $allDiscussions->pluck('user_id')->merge($allDiscussions->pluck('startingPost.last_editor_id'))->unique()->values();

            $users = User::whereIn('user_id', $userIds)->with('userGroups');

            if (!$this->isModerator) {
                $users->default();
            }

            return $users->get();
        });
    }
}
