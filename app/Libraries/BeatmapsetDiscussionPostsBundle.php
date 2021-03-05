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

class BeatmapsetDiscussionPostsBundle extends BeatmapsetDiscussionsBundleBase
{
    use Memoizes;

    public function getData()
    {
        return $this->getPosts();
    }

    public function toArray()
    {
        return [
            'beatmapsets' => json_collection($this->getBeatmapsets(), new BeatmapsetCompactTransformer()),
            'cursor' => $this->getCursor(),
            'posts' => json_collection($this->getPosts(), new BeatmapDiscussionPostTransformer(), ['beatmaps', 'users']),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer(), ['groups']),
        ];
    }

    private function getBeatmapsets()
    {
        return $this->memoize(__FUNCTION__, function () {
            $beatmapsetIds = $this->getPosts()->pluck('beatmapset.beatmapset_id')->unique()->values();

            return Beatmapset::whereIn('beatmapset_id', $beatmapsetIds)->get();
        });
    }

    private function getPosts()
    {
        return $this->memoize(__FUNCTION__, function () {
            $this->search = BeatmapDiscussionPost::search($this->params);

            // TODO: move non-api versino to React.
            $queryWith = ['user', 'beatmapset'];
            if (!is_api_request()) {
                $queryWith = array_merge($queryWith, [
                    'beatmapDiscussion',
                    'beatmapDiscussion.beatmapset',
                    'beatmapDiscussion.user.userGroups',
                    'beatmapDiscussion.startingPost',
                ]);
            }

            $query = $this->search['query']->with($queryWith)->limit($this->search['params']['limit'] + 1);

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
            $users = $this->getPosts()
                ->pluck('user')
                ->uniqueStrict('user_id')
                ->values();

            // see note in BeatmapDiscussionVotesBundle
            if (!$this->isModerator) {
                $users = $users->filter(function ($user) {
                    return !$user->isRestricted();
                });
            }

            return $users;
        });
    }
}
