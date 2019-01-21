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
use App\Models\Notification;
use App\Models\User;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class Notify implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $event;
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

    public function __construct($event, $object, $source)
    {
        $this->event = $event;
        $this->object = $object;
        $this->source = $source;
    }

    public function handle()
    {
        $this->prepare();
        $this->notifiable = $this->notifiable ?? $this->object;

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

    private function onBeatmapsetDiscussionPostNew()
    {
        $this->params['name'] = Notification::NAME_BEATMAPSET_DISCUSSION_POST_NEW;

        $this->notifiable = $this->object->beatmapset;
        $this->receiverIds = static::beatmapsetReceiverIds($this->notifiable);

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->notifiable->title,
            'post_id' => $this->object->getKey(),
            'discussion_id' => $this->object->beatmapDiscussion->getKey(),
        ];
    }

    private function onBeatmapsetDisqualify()
    {
        $this->params['name'] = Notification::NAME_BEATMAPSET_DISQUALIFY;
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetLove()
    {
        $this->params['name'] = Notification::NAME_BEATMAPSET_LOVE;
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetNominate()
    {
        $this->params['name'] = Notification::NAME_BEATMAPSET_NOMINATE;
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetQualify()
    {
        $this->params['name'] = Notification::NAME_BEATMAPSET_QUALIFY;
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetResetNominations()
    {
        $this->params['name'] = Notification::NAME_BEATMAPSET_RESET_NOMINATIONS;
        $this->receiverIds = static::beatmapsetReceiverIds($this->object);

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onForumTopicReply()
    {
        $this->params['name'] = Notification::NAME_FORUM_TOPIC_REPLY;
        $this->notifiable = $this->object->topic;

        $this->receiverIds = $this->object
            ->topic
            ->watches()
            ->where('user_id', '<>', $this->source->getKey())
            ->pluck('user_id')
            ->all();

        $this->params['details'] = [
            'username' => $this->source->username,
            'title' => $this->notifiable->topic_title,
            'post_id' => $this->object->getKey(),
            'cover_url' => optional($this->notifiable->cover)->fileUrl(),
        ];

        $this->params['created_at'] = $this->object->post_time;
    }

    private function prepare()
    {
        $function = "on{$this->event}";
        $this->$function();
    }
}
