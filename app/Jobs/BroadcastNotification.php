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
use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\InvalidNotificationException;
use App\Models\Beatmap;
use App\Models\Chat\Channel;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use App\Traits\NotificationQueue;
use DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class BroadcastNotification implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    const CONTENT_TRUNCATE = 36;

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

    public function __construct(string $name, $object, ?User $source = null)
    {
        $this->name = $name;
        $this->object = $object;
        $this->source = $source;
    }

    public function getName()
    {
        return $this->name;
    }

    public function handle()
    {
        $function = camel_case("on_{$this->name}");
        if (!method_exists($this, $function)) {
            log_error(new Exception('Invalid event name: '.$this->name));

            return;
        }

        try {
            $eventClass = $this->$function() ?? NewNotificationEvent::class;
        } catch (InvalidNotificationException $_e) {
            return;
        }

        $this->notifiable = $this->notifiable ?? $this->object;
        $this->params['name'] = $this->name;
        if ($this->source !== null) {
            $this->params['details']['username'] = $this->source->username;
        }

        if ($this->receiverIds instanceof Collection) {
            $this->receiverIds = $this->receiverIds->all();
        }

        $this->receiverIds = array_values(array_diff($this->receiverIds, [optional($this->source)->getKey()]));
        if (empty($this->receiverIds)) {
            return;
        }

        $notification = new Notification($this->params);
        $notification->notifiable()->associate($this->notifiable);
        if ($this->source !== null) {
            $notification->source()->associate($this->source);
        }

        $notification->save();

        event(new $eventClass($notification, $this->receiverIds));

        DB::transaction(function () use ($notification) {
            foreach ($this->receiverIds as $id) {
                $notification->userNotifications()->create(['user_id' => $id]);
            }
        });
    }

    private function assignBeatmapsetDiscussionNotificationDetails()
    {
        $this->params['details'] = [
            'content' => truncate($this->object->message, static::CONTENT_TRUNCATE),
            'title' => $this->notifiable->title,
            'post_id' => $this->object->getKey(),
            'discussion_id' => $this->object->beatmapDiscussion->getKey(),
            'beatmap_id' => $this->object->beatmapDiscussion->beatmap_id,
            'cover_url' => $this->notifiable->coverURL('card'),
        ];
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

        $this->assignBeatmapsetDiscussionNotificationDetails();
    }

    private function onBeatmapsetDiscussionQualifiedProblem()
    {
        $this->notifiable = $this->object->beatmapset;
        $beatmap = $this->object->beatmap;

        if ($beatmap === null) {
            $modes = $this->object->beatmapset->playmodes()->all();
        } else {
            $modes = [$beatmap->playmode];
        }

        $modes = array_map(function ($modeInt) {
            return Beatmap::modeStr($modeInt);
        }, $modes);

        $this->receiverIds = [];

        $notificationOptions = UserNotificationOption
            ::where(['name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM])
            ->whereNotNull('details')
            ->get();

        foreach ($notificationOptions as $notificationOption) {
            if (count(array_intersect($notificationOption->details['modes'], $modes)) > 0) {
                $this->receiverIds[] = $notificationOption->user_id;
            }
        }

        $this->assignBeatmapsetDiscussionNotificationDetails();

        return NewPrivateNotificationEvent::class;
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

    private function onBeatmapsetRank()
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

    private function onCommentNew()
    {
        $this->notifiable = $this->object->commentable;

        if ($this->notifiable === null) {
            throw new InvalidNotificationException("comment_new: comment #{$this->object->getKey()} missing commentable");
        }

        if ($this->source === null) {
            throw new InvalidNotificationException("comment_new: comment #{$this->object->getKey()} missing source");
        }

        $this->receiverIds = Follow::whereNotifiable($this->object->commentable)
            ->where(['subtype' => 'comment'])
            ->pluck('user_id')
            ->all();

        $this->params['details'] = [
            'comment_id' => $this->object->getKey(),
            'title' => $this->object->commentable->commentableTitle(),
            'content' => truncate($this->object->message, static::CONTENT_TRUNCATE),
            'cover_url' => $this->object->commentable->notificationCover(),
        ];
    }

    private function onChannelMessage()
    {
        $channel = Channel::findOrFail($this->object->channel_id);
        $this->receiverIds = $channel->users()->pluck('user_id')->all();
        $this->notifiable = $this->object->channel;

        $this->params['details'] = [
            'title' => truncate($this->object->content, static::CONTENT_TRUNCATE),
            'type' => strtolower($channel->type),
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

    private function onUserAchievementUnlock()
    {
        $user = $this->source;
        $achievement = $this->object;

        $this->receiverIds = [$user->getKey()];
        $this->notifiable = $user;
        $this->source = new User;
        $this->params['details'] = [
            'achievement_id' => $achievement->getKey(),
            'cover_url' => $achievement->iconUrl(),
            'slug' => $achievement->slug,
            'title' => $achievement->name,
            'user_id' => $user->getKey(),
        ];
    }
}
