<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmapset;
use App\Models\User;
use Illuminate\Support\Collection;

class BeatmapDiscussionPostsTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmapsets',
        'users',
    ];

    public function transform(Collection $posts)
    {
        return [
            'posts' => json_collection($posts, new BeatmapDiscussionPostTransformer()),
        ];
    }

    public function includeBeatmapsets(Collection $posts)
    {
        $beatmapsetIds = $posts->pluck('beatmapset_id')->unique()->values();
        $beatmapsets = Beatmapset::whereIn('beatmapset_id', $beatmapsetIds)->get();

        return $this->collection($beatmapsets, new BeatmapsetCompactTransformer());
    }

    public function includeUsers(Collection $posts)
    {
        $userIds = $posts->pluck('user_id')->unique()->values();

        $users = User::whereIn('user_id', $userIds)->with('userGroups');

        if (!$this->isModerator()) {
            $users->default();
        }

        return $this->primitive(
            json_collection(
                $users->get(),
                new UserCompactTransformer(),
                ['groups']
            )
        );
    }

    private function isModerator()
    {
        return priv_check('BeatmapDiscussionModerate')->can();
    }
}
