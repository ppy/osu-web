<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\Beatmapset;
use App\Models\User;
use League\Fractal;

class BeatmapsetDiscussionTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap_discussions',
        'beatmapset_events',
        'users',
    ];

    public function transform(Beatmapset $beatmapset)
    {
        return [
            'id' => $beatmapset->id,
            'updated_at' => json_time($beatmapset->lastDiscussionTime()),
        ];
    }

    public function includeBeatmapDiscussions(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->beatmapDiscussions()->with([
                'beatmap',
                'beatmapset',
                'beatmapDiscussionPosts',
                'beatmapDiscussionVotes',
            ])->get(),
            new BeatmapDiscussionTransformer()
        );
    }

    public function includeBeatmapsetEvents(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->events->all(),
            new BeatmapsetEventTransformer()
        );
    }

    public function includeUsers(Beatmapset $beatmapset)
    {
        $userIds = [$beatmapset->user_id];

        foreach ($beatmapset->beatmapDiscussions as $beatmapDiscussion) {
            if (!priv_check('BeatmapDiscussionShow', $beatmapDiscussion)->can()) {
                continue;
            }

            $userIds[] = $beatmapDiscussion->user_id;
            $userIds[] = $beatmapDiscussion->deleted_by_id;

            foreach ($beatmapDiscussion->beatmapDiscussionPosts as $post) {
                if (!priv_check('BeatmapDiscussionPostShow', $post)->can()) {
                    continue;
                }

                $userIds[] = $post->user_id;
                $userIds[] = $post->last_editor_id;
                $userIds[] = $post->deleted_by_id;
            }
        }

        foreach ($beatmapset->events as $event) {
            if (priv_check('BeatmapsetEventViewUserId', $event)->can()) {
                $userIds[] = $event->user_id;
            }
        }

        $userIds = array_unique($userIds);
        $users = User::with('userGroups')->whereIn('user_id', $userIds)->get();

        return $this->collection($users, new UserCompactTransformer());
    }
}
