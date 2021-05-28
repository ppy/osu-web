<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

/**
 * temporary class until simpler acl is implemented.
 *
 * @property int $auth_option_id
 * @property int $auth_role_id
 * @property int $auth_setting
 * @property int $forum_id
 * @property int $group_id
 */
class Authorize extends Model
{
    protected $table = 'phpbb_acl_groups';
    public $timestamps = false;
    protected $primaryKeys = ['group_id', 'forum_id', 'auth_option_id', 'auth_role_id', 'auth_setting'];

    public static function aclCheck($user, $authOption, $forum)
    {
        $groupIds = $user->groupIds()['active'];
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
        $groupIds = $user->groupIds()['active'];
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
