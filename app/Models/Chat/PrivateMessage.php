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

use App\Models\User;

class PrivateMessage extends Model
{
    protected $table = 'messages_private';
    protected $primaryKey = 'message_id';
    protected $dates = [
        'timestamp',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'target_id', 'user_id');
    }

    public function scopeToOrFrom($query, $user_id)
    {
        return $query->where(
            function ($q) use ($user_id) {
                $q->where('user_id', $user_id)
                ->orWhere('target_id', $user_id);
            }
        );
    }
}
