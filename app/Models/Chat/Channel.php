<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models\Chat;

use App\Events\UserSubscriptionChangeEvent;
use App\Exceptions\API;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use ChaseConey\LaravelDatadogHelper\Datadog;

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

    public function messages()
    {
        return $this->hasMany(Message::class, 'channel_id');
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

    public function pmTargetFor(User $user)
    {
        if (!$this->isPM()) {
            return;
        }

        return $this->users()->where('user_id', '<>', $user->user_id)->first();
    }

    public function receiveMessage(User $sender, string $content, bool $isAction = false)
    {
        $content = trim($content);

        if (mb_strlen($content, 'UTF-8') >= config('osu.chat.message_length_limit')) {
            throw new API\ChatMessageTooLongException(trans('api.error.chat.too_long'));
        }

        if (!present($content)) {
            throw new API\ChatMessageEmptyException(trans('api.error.chat.empty'));
        }

        $sentMessages = Message::where('user_id', $sender->user_id)
            ->join('channels', 'channels.channel_id', '=', 'messages.channel_id');

        if ($this->isPM()) {
            $limit = config('osu.chat.rate_limits.private.limit');
            $window = config('osu.chat.rate_limits.private.window');
            $sentMessages->where('type', self::TYPES['pm']);
        } else {
            $limit = config('osu.chat.rate_limits.public.limit');
            $window = config('osu.chat.rate_limits.public.window');
            $sentMessages->where('type', '!=', self::TYPES['pm']);
        }

        $sentMessages->where('timestamp', '>=', Carbon::now()->subSecond($window));

        if ($sentMessages->count() > $limit) {
            throw new API\ExcessiveChatMessagesException(trans('api.error.chat.limit_exceeded'));
        }

        $message = new Message();
        $message->user_id = $sender->user_id;
        $message->content = $content;
        $message->is_action = $isAction;
        $message->timestamp = Carbon::now();
        $message->channel()->associate($this);
        $message->save();

        $userChannel = UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $sender->user_id,
        ])->first();

        if ($userChannel) {
            $userChannel->update(['last_read_id' => $message->message_id]);
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
