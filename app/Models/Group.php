<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
