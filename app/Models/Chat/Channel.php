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

namespace App\Models\Chat;

use App\Events\UserSubscriptionChangeEvent;
use App\Exceptions\API;
use App\Models\Multiplayer\Match;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use ChaseConey\LaravelDatadogHelper\Datadog;
use Illuminate\Support\Str;
use LaravelRedis as Redis;

/**
 * @property string[] $allowed_groups
 * @property int $channel_id
 * @property \Carbon\Carbon $creation_time
 * @property string $description
 * @property \Illuminate\Database\Eloquent\Collection $messages Message
 * @property int $moderated
 * @property string $name
 * @property mixed $type
 */
class Channel extends Model
{
    protected $primaryKey = 'channel_id';
    protected $dates = [
        'creation_time',
    ];

    const TYPES = [
        'public' => 'PUBLIC',
        'private' => 'PRIVATE',
        'multiplayer' => 'MULTIPLAYER',
        'spectator' => 'SPECTATOR',
        'temporary' => 'TEMPORARY',
        'pm' => 'PM',
        'group' => 'GROUP',
    ];

    /**
     * @param User $user1
     * @param User $user2
     *
     * @return string
     */
    public static function getPMChannelName($user1, $user2)
    {
        $userIds = [$user1->getKey(), $user2->getKey()];
        sort($userIds);

        return '#pm_'.implode('-', $userIds);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function filteredMessages()
    {
        $messages = $this->messages();

        if ($this->isPublic()) {
            $messages = $messages->where('timestamp', '>', Carbon::now()->subHours(config('osu.chat.public_backlog_limit')));
        }

        // TODO: additional message filtering

        return $messages;
    }

    public function users()
    {
        // This isn't a has-many-through because the relationship is cross-database.
        return User::whereIn('user_id', UserChannel::where('channel_id', $this->channel_id)->pluck('user_id'));
    }

    public function scopePublic($query)
    {
        return $query->where('type', self::TYPES['public']);
    }

    public function scopePM($query)
    {
        return $query->where('type', self::TYPES['pm']);
    }

    public function getAllowedGroupsAttribute($allowed_groups)
    {
        return $allowed_groups === null ? [] : array_map('intval', explode(',', $allowed_groups));
    }

    public function isPublic()
    {
        return $this->type === self::TYPES['public'];
    }

    public function isPrivate()
    {
        return $this->type === self::TYPES['private'];
    }

    public function isPM()
    {
        return $this->type === self::TYPES['pm'];
    }

    public function isGroup()
    {
        return $this->type === self::TYPES['group'];
    }

    public function isBanchoMultiplayerChat()
    {
        return $this->type === self::TYPES['temporary'] && starts_with($this->name, '#mp_');
    }

    public function getMatchIdAttribute()
    {
        // TODO: add lazer mp support?
        if ($this->isBanchoMultiplayerChat()) {
            return intval(str_replace('#mp_', '', $this->name));
        }
    }

    public function multiplayerMatch()
    {
        return $this->belongsTo(Match::class, 'match_id');
    }

    public function pmTargetFor(User $user)
    {
        if (!$this->isPM()) {
            return;
        }

        return $this->users()->where('user_id', '<>', $user->user_id)->first();
    }

    public function receiveMessage(User $sender, string $content, bool $isAction = false)
    {
        if ($this->isPM()) {
            $limit = config('osu.chat.rate_limits.private.limit');
            $window = config('osu.chat.rate_limits.private.window');
            $keySuffix = 'PM';
        } else {
            $limit = config('osu.chat.rate_limits.public.limit');
            $window = config('osu.chat.rate_limits.public.window');
            $keySuffix = 'PUBLIC';
        }

        $key = "message_throttle:{$sender->user_id}:{$keySuffix}";
        $now = now();

        // This works by keeping a sorted set of when the last messages were sent by the user (per message type).
        // The timestamp of the message is used as the score, which allows for zremrangebyscore to cull old messages
        // in a rolling window fashion.
        [,$sent] = Redis::transaction()
            ->zremrangebyscore($key, 0, $now->timestamp - $window)
            ->zrange($key, 0, -1, 'WITHSCORES')
            ->zadd($key, $now->timestamp, (string) Str::uuid())
            ->expire($key, $window)
            ->exec();

        if (count($sent) >= $limit) {
            throw new API\ExcessiveChatMessagesException(trans('api.error.chat.limit_exceeded'));
        }

        $content = trim($content);

        if (mb_strlen($content, 'UTF-8') >= config('osu.chat.message_length_limit')) {
            throw new API\ChatMessageTooLongException(trans('api.error.chat.too_long'));
        }

        if (!present($content)) {
            throw new API\ChatMessageEmptyException(trans('api.error.chat.empty'));
        }

        $message = new Message();
        $message->user_id = $sender->user_id;
        $message->content = $content;
        $message->is_action = $isAction;
        $message->timestamp = $now;
        $message->channel()->associate($this);
        $message->save();

        $userChannel = UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $sender->user_id,
        ])->first();

        if ($userChannel) {
            $userChannel->markAsRead($message->message_id);
        }

        if ($this->isPM()) {
            $this->unhide();
            broadcast_notification(Notification::CHANNEL_MESSAGE, $message, $sender);
        }

        Datadog::increment('chat.channel.send', 1, ['target' => $this->type]);

        return $message;
    }

    public function addUser(User $user)
    {
        $userChannel = UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
        ])->first();

        if ($userChannel) {
            $userChannel->update(['hidden' => false]);
        } else {
            $userChannel = new UserChannel();
            $userChannel->user()->associate($user);
            $userChannel->channel()->associate($this);
            $userChannel->save();
        }

        if ($this->isPM()) {
            event(new UserSubscriptionChangeEvent('add', $user, $this));
        }

        Datadog::increment('chat.channel.join', 1, ['type' => $this->type]);
    }

    public function removeUser(User $user)
    {
        $userChannel = UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
            'hidden' => false,
        ])->first();

        if (!$userChannel) {
            return;
        }

        if ($this->isPM()) {
            event(new UserSubscriptionChangeEvent('remove', $user, $this));
            $userChannel->update(['hidden' => true]);
        } else {
            $userChannel->delete();
        }

        Datadog::increment('chat.channel.part', 1, ['type' => $this->type]);
    }

    public function hasUser(User $user)
    {
        return UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
            'hidden' => false,
        ])->exists();
    }

    private function unhide()
    {
        if (!$this->isPM()) {
            return;
        }

        $hiddenUserChannels = UserChannel::where([
            'channel_id' => $this->channel_id,
            'hidden' => true,
        ]);

        foreach ($hiddenUserChannels->get() as $userChannel) {
            event(new UserSubscriptionChangeEvent('add', $userChannel->user, $this));
        }

        $hiddenUserChannels->update([
            'hidden' => false,
        ]);
    }
}
