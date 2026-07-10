<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Builder;

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
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['group_id', 'forum_id', 'auth_option_id', 'auth_role_id', 'auth_setting'];
    protected $table = 'phpbb_acl_groups';

    public static function aclCheck($user, $authOption, $forum)
    {
        return static::acl($user->groupIds(), $authOption)
            ->where('forum_id', $forum->forum_id)
            ->exists();
    }

    public static function increasesPostsCount($user, $forum)
    {
        return $forum->enable_indexing && static::aclCheck($user, 'f_postcount', $forum);
    }

    public static function postsCountedForums($user): array
    {
        return Forum::searchable()
            ->whereIn('forum_id', static::acl($user->groupIds(), 'f_postcount')->select('forum_id'))
            ->pluck('forum_id')
            ->all();
    }

    public function scopeAcl(Builder $query, array $groupIds, string $authOption): void
    {
        $authOptionId = AuthOption::where('auth_option', $authOption)->value('auth_option_id');

        // there's actually another one (phpbb_acl_users) but doesn't seem
        // to contain anything but old-ish banlist?
        $query
            ->orWhere(fn ($q) => $q->directAcl($groupIds, $authOptionId))
            ->orWhere(fn ($q) => $q->roleAcl($groupIds, $authOptionId));
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
