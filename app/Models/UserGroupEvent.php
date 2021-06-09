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
    const USER_ADD_PLAYMODES = 'user_add_playmodes';
    const USER_REMOVE = 'user_remove';
    const USER_REMOVE_PLAYMODES = 'user_remove_playmodes';
    const USER_SET_DEFAULT = 'user_set_default';

    const UPDATED_AT = null;

    protected $casts = [
        'details' => 'array',
        'hidden' => 'boolean',
    ];

    public static function logGroupRename(?User $actor, Group $group, string $previousName, string $name): self
    {
        return static::log($actor, static::GROUP_RENAME, null, $group, [
            'details' => [
                'group_name' => $name,
                'previous_group_name' => $previousName,
            ],
        ]);
    }

    public static function logUserAdd(?User $actor, User $user, Group $group, array $playmodes): self
    {
        return static::log($actor, static::USER_ADD, $user, $group, [
            'details' => compact('playmodes'),
        ]);
    }

    public static function logUserAddPlaymodes(?User $actor, User $user, Group $group, array $playmodes): self
    {
        return static::log($actor, static::USER_ADD_PLAYMODES, $user, $group, [
            'details' => compact('playmodes'),
        ]);
    }

    public static function logUserRemove(?User $actor, User $user, Group $group): self
    {
        return static::log($actor, static::USER_REMOVE, $user, $group);
    }

    public static function logUserRemovePlaymodes(?User $actor, User $user, Group $group, array $playmodes): self
    {
        return static::log($actor, static::USER_REMOVE_PLAYMODES, $user, $group, [
            'details' => compact('playmodes'),
        ]);
    }

    public static function logUserSetDefault(?User $actor, User $user, Group $group): self
    {
        return static::log($actor, static::USER_SET_DEFAULT, $user, $group, [
            'hidden' => true,
        ]);
    }

    private static function log(?User $actor, string $type, ?User $user, Group $group, array $attributes = []): self
    {
        $attributes['details'] = array_merge(
            [
                'actor_name' => optional($actor)->username,
                'group_name' => $group->group_name,
                'user_name' => optional($user)->username,
            ],
            $attributes['details'] ?? [],
        );

        return static::create(array_merge(
            [
                'actor_id' => optional($actor)->getKey(),
                'group_id' => $group->getKey(),
                'hidden' => !$group->hasListing(),
                'type' => $type,
                'user_id' => optional($user)->getKey(),
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
