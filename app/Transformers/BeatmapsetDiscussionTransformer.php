<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Transformers;

use App\Models\BeatmapsetDiscussion;
use App\Models\User;
use League\Fractal;

class BeatmapsetDiscussionTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap_discussions',
        'users',
    ];

    public function transform(BeatmapsetDiscussion $discussion)
    {
        return [
            'id' => $discussion->id,
            'created_at' => json_time($discussion->created_at),
            'updated_at' => json_time($discussion->updated_at),
        ];
    }

    public function includeBeatmapDiscussions(BeatmapsetDiscussion $discussion)
    {
        return $this->collection(
            $discussion->beatmapDiscussions->all(),
            new BeatmapDiscussionTransformer()
        );
    }

    public function includeUsers(BeatmapsetDiscussion $discussion)
    {
        $userIds = [$discussion->beatmapset->user_id];

        foreach ($discussion->beatmapDiscussions as $beatmapDiscussion) {
            if (!priv_check('BeatmapDiscussionShow', $beatmapDiscussion)->can()) {
                continue;
            }

            $userIds[] = $beatmapDiscussion->user_id;

            foreach ($beatmapDiscussion->beatmapDiscussionPosts as $post) {
                if (!priv_check('BeatmapDiscussionPostShow', $post)->can()) {
                    continue;
                }

                $userIds[] = $post->user_id;
                $userIds[] = $post->last_editor_id;
                $userIds[] = $post->deleted_by;
            }
        }

        $userIds = array_unique($userIds);
        $users = User::whereIn('user_id', $userIds)->get();

        return $this->collection($users, new UserCompactTransformer());
    }
}
