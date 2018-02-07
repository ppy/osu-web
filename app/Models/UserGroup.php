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

namespace App\Models;

class UserGroup extends Model
{
    protected $table = 'phpbb_user_group';
    public $timestamps = false;
    protected $guarded = [];

    // taken from current forum
    const GROUPS = [
        'default' => 2,
        'gmt' => 4,
        'admin' => 5,
        'qat' => 7,
        'dev' => 11,
        'alumni' => 16,
        'hax' => 17,
        'mod' => 18,
        'bng' => 28,
        'bot' => 29,
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
