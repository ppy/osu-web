<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BeatmapDiscussionPost;
use App\Traits\Memoizes;
use App\Transformers\BeatmapDiscussionPostTransformer;
use App\Transformers\BeatmapDiscussionTransformer;
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
        return array_merge([
            'beatmapsets' => json_collection($this->getBeatmapsets(), new BeatmapsetCompactTransformer()),
            'discussions' => json_collection($this->getDiscussions(), new BeatmapDiscussionTransformer()),
            'posts' => json_collection($this->getPosts(), new BeatmapDiscussionPostTransformer()),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer()),
        ], cursor_for_response($this->getCursor()));
    }

    private function getBeatmapsets()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->getPosts()->pluck('beatmapDiscussion.beatmapset')->uniqueStrict('id')->values();
        });
    }

    private function getDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->getPosts()->pluck('beatmapDiscussion')->uniqueStrict('id')->values();
        });
    }

    private function getPosts()
    {
        return $this->memoize(__FUNCTION__, function () {
            ['query' => $query, 'params' => $params] = BeatmapDiscussionPost::search($this->params);

            $posts = $query->with(['user.userGroups', 'beatmapDiscussion.beatmapset'])->limit($params['limit'] + 1)->get();

            $this->paginator = new Paginator(
                $posts,
                $params['limit'],
                $params['page'],
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'query' => $params,
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
