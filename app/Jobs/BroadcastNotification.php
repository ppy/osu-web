<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\InvalidNotificationException;
use App\Libraries\BeatmapsetDiscussionReview;
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

    private static function beatmapsetWatcherUserIds($beatmapset)
    {
        return static::filterUserIdsForNotificationOption(
            $beatmapset->watches()->pluck('user_id')->all(),
            UserNotificationOption::BEATMAPSET_MODDING
        );
    }

    private static function filterUserIdsForNotificationOption(array $userIds, $optionName)
    {
        // FIXME: filtering all the ids could get quite large?
        $notificationOptions = UserNotificationOption
            ::whereIn('user_id', $userIds)
            ->where(['name' => $optionName])
            ->whereNotNull('details')
            ->get()
            ->keyBy('user_id');

        $filteredUserIds = [];
        foreach ($userIds as $userId) {
            if ($notificationOptions[$userId]->details['push'] ?? true) {
                $filteredUserIds[] = $userId;
            }
        }

        return $filteredUserIds;
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
            $this->$function();
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

        $this->receiverIds = array_values(array_unique(array_diff($this->receiverIds, [optional($this->source)->getKey()])));

        if (empty($this->receiverIds)) {
            return;
        }

        $notification = new Notification($this->params);
        $notification->notifiable()->associate($this->notifiable);
        if ($this->source !== null) {
            $notification->source()->associate($this->source);
        }

        $notification->save();

        event(new NewPrivateNotificationEvent($notification, $this->receiverIds));

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
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetDiscussionUnlock()
    {
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetDiscussionPostNew()
    {
        $this->notifiable = $this->object->beatmapset;
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->notifiable);

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
            if (count(array_intersect($notificationOption->details['modes'] ?? [], $modes)) > 0) {
                $this->receiverIds[] = $notificationOption->user_id;
            }
        }

        $this->receiverIds = static::filterUserIdsForNotificationOption(
            $this->receiverIds,
            UserNotificationOption::BEATMAPSET_MODDING
        );

        $this->assignBeatmapsetDiscussionNotificationDetails();
    }

    private function onBeatmapsetDiscussionReviewNew()
    {
        $this->notifiable = $this->object->beatmapset;
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->notifiable);
        $stats = BeatmapsetDiscussionReview::getStats(json_decode($this->object->startingPost->message, true));

        $this->params['details'] = [
            'title' => $this->notifiable->title,
            'post_id' => $this->object->startingPost->getKey(),
            'discussion_id' => $this->object->getKey(),
            'beatmap_id' => $this->object->beatmap_id,
            'cover_url' => $this->notifiable->coverURL('card'),
            'embeds' => [
                'suggestions' => $stats['suggestions'],
                'problems' => $stats['problems'],
                'praises' => $stats['praises'],
            ],
        ];
    }

    private function onBeatmapsetDisqualify()
    {
        $modes = $this->object->playmodes()->all();
        $modes = array_map(function ($modeInt) {
            return Beatmap::modeStr($modeInt);
        }, $modes);

        $notificationOptions = UserNotificationOption
            ::where(['name' => Notification::BEATMAPSET_DISQUALIFY])
            ->whereNotNull('details')
            ->get();

        $this->receiverIds = [];

        foreach ($notificationOptions as $notificationOption) {
            if (count(array_intersect($notificationOption->details['modes'] ?? [], $modes)) > 0) {
                $this->receiverIds[] = $notificationOption->user_id;
            }
        }

        $this->receiverIds = static::filterUserIdsForNotificationOption(
            $this->receiverIds,
            UserNotificationOption::BEATMAPSET_MODDING
        );

        $this->receiverIds = array_merge($this->receiverIds, static::beatmapsetWatcherUserIds($this->object));

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetLove()
    {
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetNominate()
    {
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetQualify()
    {
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetRank()
    {
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

        $this->params['details'] = [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    private function onBeatmapsetResetNominations()
    {
        $this->receiverIds = static::beatmapsetWatcherUserIds($this->object);

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

        $this->receiverIds = static::filterUserIdsForNotificationOption(
            $this->receiverIds,
            UserNotificationOption::FORUM_TOPIC_REPLY
        );

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
            'achievement_mode' => $achievement->mode,
            'cover_url' => $achievement->iconUrl(),
            'slug' => $achievement->slug,
            'title' => $achievement->name,
            'user_id' => $user->getKey(),
        ];
    }
}
