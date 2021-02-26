<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use App\Traits\Memoizes;
use App\Transformers\BeatmapDiscussionPostTransformer;
use App\Transformers\BeatmapsetCompactTransformer;
use App\Transformers\UserCompactTransformer;
use Illuminate\Pagination\Paginator;

class BeatmapsetDiscussionPostsBundle
{
    use Memoizes;

    private $isModerator;
    private $paginator;
    private $params;
    private $search;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->isModerator = priv_check('BeatmapDiscussionModerate')->can();
        if (!$this->isModerator) {
            $this->params['with_deleted'] = false;
        }
    }

    public function getPaginator()
    {
        if ($this->paginator === null) {
            $this->getPosts();
        }

        return $this->paginator;
    }

    public function toArray()
    {
        $paginator = $this->getPaginator();
        $cursor = $paginator->hasMorePages() ? [
            // TODO: move to non-offset
            'page' => $paginator->currentPage() + 1,
            'limit' => $paginator->perPage(),
        ] : null;

        return [
            'beatmapsets' => json_collection($this->getBeatmapsets(), new BeatmapsetCompactTransformer()),
            'cursor' => $cursor,
            'posts' => json_collection($this->getPosts(), new BeatmapDiscussionPostTransformer(), ['beatmaps', 'users']),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer(), ['groups']),
        ];
    }

    private function getBeatmapsets()
    {
        return $this->memoize(__FUNCTION__, function () {
            $beatmapsetIds = $this->getPosts()->pluck('beatmapset_id')->unique()->values();
            return Beatmapset::whereIn('beatmapset_id', $beatmapsetIds)->get();
        });
    }

    private function getPosts()
    {
        return $this->memoize(__FUNCTION__, function () {
            $this->search = BeatmapDiscussionPost::search($this->params);

            $queryWith = ['user', 'beatmapset'];
            if (!is_api_request()) {
                $queryWith = array_merge($queryWith, [
                    'beatmapDiscussion',
                    'beatmapDiscussion.beatmapset',
                    'beatmapDiscussion.user',
                    'beatmapDiscussion.startingPost',
                ]);
            }

            $query = $this->search['query']->with($queryWith)->limit($this->search['params']['limit'] + 1);

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

    private function getUsers()
    {
        return $this->memoize(__FUNCTION__, function () {
            $userIds = $this->getPosts()->pluck('user_id')->unique()->values();

            $users = User::whereIn('user_id', $userIds)->with('userGroups');

            if (!$this->isModerator) {
                $users->default();
            }

            return $users->get();
        });
    }
}
