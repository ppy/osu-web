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

namespace App\Models\Chat;

use App\Exceptions\API;
use App\Models\User;
use Carbon\Carbon;

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

        if ($this->type === self::TYPES['public']) {
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
        return array_map('intval', explode(',', $allowed_groups));
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
        if (mb_strlen($content, 'UTF-8') >= config('osu.chat.message_length_limit')) {
            throw new API\ChatMessageTooLongException(trans('api.error.chat.too_long'));
        }

        $sentMessages = Message::where('user_id', $sender->user_id)
            ->join('channels', 'channels.channel_id', '=', 'messages.channel_id');

        if ($this->type === self::TYPES['pm']) {
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

        $userChannel = UserChannel::where(['channel_id' => $this->channel_id, 'user_id' => $sender->user_id])->first();
        if ($userChannel) {
            $userChannel->update(['last_read_id' => $message->message_id]);
        }

        return $message;
    }

    public function addUser(User $user)
    {
        // TODO: Remove this when join restriction is lifted
        if ($this->type !== self::TYPES['public']) {
            return;
        }

        $userChannel = new UserChannel();
        $userChannel->user()->associate($user);
        $userChannel->channel()->associate($this);
        $userChannel->save();
    }

    public function removeUser(User $user)
    {
        // TODO: Remove this when join restriction is lifted
        if ($this->type !== self::TYPES['public']) {
            return;
        }

        UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
        ])->delete();
    }

    public function hasUser(User $user)
    {
        return UserChannel::where(['channel_id' => $this->channel_id, 'user_id' => $user->user_id])->exists();
    }
}
