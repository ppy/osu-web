<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property User|null $actor
 * @property int|null $actor_id
 * @property \Carbon\Carbon $created_at
 * @property array|null $details
 * @property Group $group
 * @property int $group_id
 * @property bool $hidden
 * @property int $id
 * @property string $type
 * @property User|null $user
 * @property int|null $user_id
 */
class UserGroupEvent extends Model
{
    const GROUP_ADD = 'group_add';
    const GROUP_REMOVE = 'group_remove';
    const GROUP_RENAME = 'group_rename';
    const USER_ADD = 'user_add';
    const USER_ADD_MODES = 'user_add_modes';
    const USER_REMOVE = 'user_remove';
    const USER_REMOVE_MODES = 'user_remove_modes';
    const USER_SET_DEFAULT = 'user_set_default';

    const UPDATED_AT = null;

    protected $casts = [
        'details' => 'array',
        'hidden' => 'boolean',
    ];

    public static function logGroupRename(?User $actor, Group $group, string $oldName, string $newName): self
    {
        return static::log($actor, static::GROUP_RENAME, $group, [
            'details' => [
                'old_name' => $oldName,
                'new_name' => $newName,
            ],
        ]);
    }

    public static function logUserAdd(?User $actor, User $user, Group $group, array $modes): self
    {
        return static::log($actor, static::USER_ADD, $group, [
            'details' => [
                'modes' => $modes,
            ],
            'user_id' => $user->getKey(),
        ]);
    }

    public static function logUserAddModes(?User $actor, User $user, Group $group, array $modes): self
    {
        return static::log($actor, static::USER_ADD_MODES, $group, [
            'details' => [
                'modes' => $modes,
            ],
            'user_id' => $user->getKey(),
        ]);
    }

    public static function logUserRemove(?User $actor, User $user, Group $group): self
    {
        return static::log($actor, static::USER_REMOVE, $group, [
            'user_id' => $user->getKey(),
        ]);
    }

    public static function logUserRemoveModes(?User $actor, User $user, Group $group, array $modes): self
    {
        return static::log($actor, static::USER_REMOVE_MODES, $group, [
            'details' => [
                'modes' => $modes,
            ],
            'user_id' => $user->getKey(),
        ]);
    }


    public static function logUserSetDefault(?User $actor, User $user, Group $group): self
    {
        return static::log($actor, static::USER_SET_DEFAULT, $group, [
            'hidden' => true,
            'user_id' => $user->getKey(),
        ]);
    }

    private static function log(?User $actor, string $type, Group $group, array $attributes = []): self
    {
        return static::create(array_merge(
            [
                'actor_id' => optional($actor)->getKey(),
                'group_id' => $group->getKey(),
                'hidden' => !$group->isVisible(),
                'type' => $type,
            ],
            $attributes,
        ));
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
