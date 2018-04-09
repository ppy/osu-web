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

namespace App\Models\Forum;

// temporary class until simpler acl is implemented
class Authorize extends Model
{
    protected $table = 'phpbb_acl_groups';
    public $timestamps = false;

    protected $guarded = [];

    public static function aclCheck($user, $authOption, $forum)
    {
        $groupIds = $user->groupIds();
        $authOptionId = AuthOption::where('auth_option', $authOption)->value('auth_option_id');

        // the group may contain direct acl entry
        $isAuthorized = static::directAcl($groupIds, $authOptionId)
            ->where('forum_id', $forum->forum_id)
            ->exists();

        // the group may also be part of role which may have matching
        // acl entry
        if (!$isAuthorized) {
            $isAuthorized = static::roleAcl($groupIds, $authOptionId)
                ->where('forum_id', $forum->forum_id)
                ->exists();
        }

        // there's actually another one (phpbb_acl_users) but doesn't seem
        // to contain anything but old-ish banlist?
        return $isAuthorized;
    }

    public static function aclGetAllowedForums($user, $authOption)
    {
        $groupIds = $user->groupIds();
        $authOptionId = AuthOption::where('auth_option', $authOption)->value('auth_option_id');

        $directAclForumIds = model_pluck(static::directAcl($groupIds, $authOptionId), 'forum_id');
        $roleAclForumIds = model_pluck(static::roleAcl($groupIds, $authOptionId), 'forum_id');

        return array_values(array_unique(array_merge($directAclForumIds, $roleAclForumIds)));
    }

    public static function increasesPostsCount($user, $forum)
    {
        return static::aclCheck($user, 'f_postcount', $forum);
    }

    public static function postsCountedForums($user)
    {
        return static::aclGetAllowedForums($user, 'f_postcount');
    }

    public function scopeDirectAcl($query, $groupIds, $authOptionId)
    {
        return $query
            ->where([
                'auth_setting' => 1,
                'auth_option_id' => $authOptionId,
            ])
            ->whereIn('group_id', $groupIds);
    }

    public function scopeRoleAcl($query, $groupIds, $authOptionId)
    {
        $roleIds = model_pluck(AuthRole::where([
            'auth_setting' => 1,
            'auth_option_id' => $authOptionId,
        ]), 'role_id');

        return $query
            ->where([
                'auth_setting' => 0,
            ])
            ->whereIn('auth_role_id', $roleIds)
            ->whereIn('group_id', $groupIds);
    }
}
