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

use App\Models\User;

class Channel extends Model
{
    protected $primaryKey = 'channel_id';
    protected $dates = [
        'creation_time',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'channel_id');
    }

    public function getAllowedGroupsAttribute($allowed_groups)
    {
        return array_map('intval', explode(',', $allowed_groups));
    }

    public function getTypeAttribute($type)
    {
        return strtolower($type);
    }

    public function isPM()
    {
        return $this->type === 'pm';
    }

    public function pmTargetFor(User $user)
    {
        if (!$user || !$this->isPM()) {
            return;
        }

        return $this->users()->where('user_id', '<>', $user->user_id)->first();
    }

    public function receiveMessage(User $sender, $body, $isAction = false)
    {
        $message = new Message();
        $message->user_id = $sender->user_id;
        $message->content = $body;
        $message->is_action = $isAction;
        $message->channel()->associate($this);
        $message->save();
        $message = $message->fresh();

        $userChannel = UserChannel::where(['channel_id' => $this->channel_id, 'user_id' => $sender->user_id]);
        if ($userChannel) {
            $userChannel->update(['last_read_id' => $message->message_id]);
        }

        return $message;
    }

    public function users()
    {
        return User::whereIn('user_id', UserChannel::where('channel_id', $this->channel_id)->pluck('user_id'));
    }

    public function addUser(User $user)
    {
        // TODO: Remove this when join restriction is lifted
        if ($this->type !== 'public') {
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
        if ($this->type !== 'public') {
            return;
        }

        $userChannel = UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
        ]);

        $userChannel->delete();
    }

    public function hasUser(User $user)
    {
        return UserChannel::where(['channel_id' => $this->channel_id, 'user_id' => $user->user_id])->exists();
    }
}
