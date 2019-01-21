<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Jobs;

use App\Events\All;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class Notify implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $object;
    private $params;
    private $receiverIds;
    private $source;

    public static function onBeatmapsetDiscussionPostNew($source, $post)
    {
        $details = [
            'username' => $source->username,
            'title' => $post->beatmapset->title,
            'beatmapset_id' => $post->beatmapset->getKey(),
            'discussion_id' => $post->beatmapDiscussion->getKey(),
        ];

        $receiverIds = $post
            ->beatmapset
            ->watches
            ->where('user_id', '<>', $source->getKey())
            ->pluck('user_id')
            ->all();

        return new static($source, $receiverIds, $post, [
            'details' => $details,
            'is_private' => true,
            'name' => 'beatmapset_discussion_post_new',
        ]);
    }

    public static function onBeatmapsetDisqualify($source, $beatmapset)
    {
        $details = [
            'username' => $source->username,
            'title' => $beatmapset->title,
        ];

        return new static($source, null, $beatmapset, [
            'details' => $details,
            'is_private' => false,
            'name' => 'beatmapset_disqualify',
        ]);
    }

    public static function onBeatmapsetLove($source, $beatmapset)
    {
        $details = [
            'username' => $source->username,
            'title' => $beatmapset->title,
        ];

        return new static($source, null, $beatmapset, [
            'details' => $details,
            'is_private' => false,
            'name' => 'beatmapset_love',
        ]);
    }

    public static function onBeatmapsetNominate($source, $beatmapset)
    {
        $details = [
            'username' => $source->username,
            'title' => $beatmapset->title,
        ];

        return new static($source, null, $beatmapset, [
            'details' => $details,
            'is_private' => false,
            'name' => 'beatmapset_nominate',
        ]);
    }

    public static function onBeatmapsetQualify($source, $beatmapset)
    {
        $details = [
            'username' => $source->username,
            'title' => $beatmapset->title,
        ];

        return new static($source, null, $beatmapset, [
            'details' => $details,
            'is_private' => false,
            'name' => 'beatmapset_qualify',
        ]);
    }

    public static function onBeatmapsetResetNominations($source, $beatmapset)
    {
        $details = [
            'username' => $source->username,
            'title' => $beatmapset->title,
        ];

        return new static($source, null, $beatmapset, [
            'details' => $details,
            'is_private' => false,
            'name' => 'beatmapset_reset_nominations',
        ]);
    }

    public static function onForumTopicReply($source, $post)
    {
        $topic = $post->topic;

        $receiverIds = $post
            ->topic
            ->watches()
            ->where('user_id', '<>', $source->getKey())
            ->pluck('user_id')
            ->all();

        $details = [
            'username' => $source->username,
            'title' => $topic->topic_title,
        ];

        return new static($source, $receiverIds, $post, [
            'details' => $details,
            'is_private' => true,
            'name' => 'post_reply',
        ]);
    }

    public function __construct($source, $receiverIds, $object, $params)
    {
        $this->source = $source;
        $this->receiverIds = $receiverIds;
        $this->object = $object;
        $this->params = $params;
    }

    public function handle()
    {
        $notification = new Notification($this->params);
        $notification->notifiable()->associate($this->object);
        $notification->source()->associate($this->source);

        if (is_array($this->receiverIds)) {
            $receivers = User::whereIn('user_id', $this->receiverIds)->get();
        }

        $notification->save();

        if (isset($receivers)) {
            foreach ($receivers as $user) {
                $notification->userNotifications()->create(['user_id' => $user->getKey()]);
            }
        }

        event(new All($notification));
    }
}
