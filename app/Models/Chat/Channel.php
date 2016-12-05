<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App\Interfaces\Messageable;
use App\Models\User;

class Channel extends Model implements Messageable
{
    protected $table = 'channels';
    protected $primaryKey = 'channel_id';
    protected $dates = [
        'creation_time',
    ];

    public function messages()
    {
        $this->hasMany(Message::class, 'channel_id', 'channel_id');
    }

    public function getAllowedGroupsAttribute($allowed_groups)
    {
        return array_map('intval', explode(',', $allowed_groups));
    }

    public function sendMessage(User $sender, $body)
    {
        $message = new Message();
        $message->user_id = $sender->user_id;
        $message->content = $body;
        $message->channel()->associate($this);
        $message->save();

        return true;
    }
}
