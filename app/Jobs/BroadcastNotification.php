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

use App\Events\NewNotificationEvent;
use App\Models\Chat\Channel;
use App\Models\Notification;
use App\Models\User;
use App\Traits\NotificationQueue;
use DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastNotification implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    private $name;
    private $notifiable;
    private $object;
    private $params = [];
    private $receiverIds;
    private $source;

    private static function beatmapsetReceiverIds($beatmapset)
    {
        return $beatmapset
            ->watches()
            ->pluck('user_id')
            ->all();
    }

    public function __construct($name, $object, $source)
    {
        $this->name = $name;
        $this->object = $object;
        $this->source = $source;
    }

    public function handle()
    {
        $function = camel_case("on_{$this->name}");
        if (!method_exists($this, $function)) {
            log_error(new Exception('Invalid event name: '.$this->name));

            return;
        }
        $this->$function();

        $this->notifiable = $this->notifiable ?? $this->object;
        $this->params['name'] = $this->name;
        $this->params['details']['username'] = $this->source->username;

        if (is_array($this->receiverIds)) {
            switch (count($this->receiverIds)) {
                case 0:
                    return;
                case 1:
                    if ($this->receiverIds[0] === $this->source->getKey()) {
                        return;
                    }
            }
        }

        $notification = new Notification($this->params);
        $notification->notifiable()->associate($this->notifiable);
        $notification->source()->associate($this->source);

        $notification->save();

        event(new NewNotificationEvent($notification));

        if (is_array($this->receiverIds)) {
            DB::transaction(function () use ($notification) {
                $receivers = User::whereIn('user_id', $this->receiverIds)->get();

                foreach ($receivers as $receiver) {
                    if ($receiver->getKey() !== $this->source->getKey()) {
                        $notification->userNotifications()->create(['user_id' => $receiver->getKey()]);
                    }
                }
            });
        }
    }

    private function onBeatmapsetDiscussionLock()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetDiscussionUnlock()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetDiscussionPostNew()
    {
        $this->notifiable = $this->object->beatmapset;
        $this->receiverIds = static::beatmapsetReceiverIds($this->notifiable);

        $this->params['details'] = [
            'title' => $this->notifiable->title,
            'post_id' => $this->object->getKey(),
            'discussion_id' => $this->object->beatmapDiscussion->getKey(),
            'beatmap_id' => $this->object->beatmapDiscussion->beatmap_id,
            'cover_url' => $this->notifiable->coverURL('card'),
        ];
    }

    private function onBeatmapsetDisqualify()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetLove()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetNominate()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetQualify()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetResetNominations()
    {
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onChannelMessage()
    {
        $channel = Channel::findOrFail($this->object->channel_id);
        $this->receiverIds = $channel->users()->pluck('user_id')->all();
        $this->notifiable = $this->object->channel;

        $this->params['details'] = [
            'title' => truncate($this->object->content, 36),
            'cover_url' => $this->source->user_avatar,
        ];
    }

    private function onForumTopicReply()
    {
        $this->notifiable = $this->object->topic;

        $this->receiverIds = $this->object
            ->topic
            ->watches()
            ->where('mail', true)
            ->where('user_id', '<>', $this->source->getKey())
            ->pluck('user_id')
            ->all();

        $this->params['details'] = [
            'title' => $this->notifiable->topic_title,
            'post_id' => $this->object->getKey(),
            'cover_url' => optional($this->notifiable->cover)->fileUrl(),
        ];

        $this->params['created_at'] = $this->object->post_time;
    }
}
