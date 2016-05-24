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
namespace App\Models\Forum;

use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Model;

// temporary class until simpler acl is implemented
class Authorize extends Model
{
    const OPTIONS = [
        // acl_options where auth_option = 'f_post'
        'post' => 17,
        // acl_options where auth_option = 'f_postcount'
        'postsCount' => 18,
    ];

    const ROLES = [
        // acl_roles_data where auth_option_id = 17
        'canPost' => [14, 21],
    ];

    protected $table = 'phpbb_acl_groups';

    public static function aclCheck($user, $authOption, $forum)
    {
        $groupIds = $user->groupIds();
        $authOptionId = AuthOption::where('auth_option', $authOption)->value('auth_option_id');

        // the group may contain direct acl entry
        $isAuthorized = static::where([
            'forum_id' => $forum->forum_id,
            // auth_setting means the actual acl
            // ...or so I think.
            'auth_setting' => 1,
            'auth_option_id' => $authOptionId,
        ])
        ->whereIn('group_id', $groupIds)
        ->exists();

        // the group may also be part of role which may have matching
        // acl entry
        if (!$isAuthorized) {
            // first get all role_id which matches requested auth option
            $roleIds = model_pluck(AuthRole::where([
                'auth_setting' => 1,
                'auth_option_id' => $authOptionId,
            ]), 'role_id');

            $isAuthorized = static::where([
                'forum_id' => $forum->forum_id,
                'auth_setting' => 0,
            ])
            ->whereIn('auth_role_id', $roleIds)
            ->whereIn('group_id', $groupIds)
            ->exists();
        }

        // there's actually another one (phpbb_acl_users) but doesn't seem
        // to contain anything but old-ish banlist?
        return $isAuthorized;
    }

    public static function increasesPostsCount($forum)
    {
        return static::where('group_id', UserGroup::GROUPS['default'])
            ->where('forum_id', $forum->forum_id)
            ->where('auth_option_id', static::OPTIONS['postsCount'])
            ->exists();
    }

    public static function postsCountedForums()
    {
        return model_pluck(
            static::where('group_id', UserGroup::GROUPS['default'])
                ->where('auth_option_id', static::OPTIONS['postsCount']),
            'forum_id');
    }
}
