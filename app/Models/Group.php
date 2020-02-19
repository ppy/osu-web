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

namespace App\Models;

/**
 * @property string $group_avatar
 * @property int $group_avatar_height
 * @property int $group_avatar_type
 * @property int $group_avatar_width
 * @property string $group_colour
 * @property string $group_desc
 * @property string $group_desc_bitfield
 * @property int $group_desc_options
 * @property string $group_desc_uid
 * @property int $group_display
 * @property int $group_founder_manage
 * @property int $group_id
 * @property int $group_legend
 * @property int $group_message_limit
 * @property string $group_name
 * @property int $group_rank
 * @property int $group_receive_pm
 * @property int $group_sig_chars
 * @property int $group_type
 */
class Group extends Model
{
    protected $table = 'phpbb_groups';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    public function scopeVisible($query)
    {
        return $query->where('group_type', 1);
    }

    public function getColourAttribute($value)
    {
        if (!present($value)) {
            return;
        }

        if (strlen($value) === 6 || strlen($value) === 3 && ctype_xdigit($value)) {
            return "#{$value}";
        }

        return $value;
    }

    public function users()
    {
        // 'cuz hasManyThrough is derp
        $userIds = UserGroup::where('group_id', $this->group_id)->pluck('user_id');

        return User::whereIn('user_id', $userIds);
    }
}
