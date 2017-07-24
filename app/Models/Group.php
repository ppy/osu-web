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

class Group extends Model
{
    protected $table = 'phpbb_groups';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    public function scopeVisible($query)
    {
        return $query->where('group_type', 1);
    }

    public function users()
    {
        // 'cuz hasManyThrough is derp
        $userIds = UserGroup::where('group_id', $this->group_id)->pluck('user_id');

        return User::whereIn('user_id', $userIds);
    }
}
