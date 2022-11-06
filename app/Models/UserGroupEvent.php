<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Exceptions\ModelNotSavedException;
use App\Models\Traits\WithDbCursorHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read User|null $actor
 * @property int|null $actor_id
 * @property \Carbon\Carbon $created_at
 * @property-read string $created_at_json
 * @property array $details
 * @property-read Group $group
 * @property int $group_id
 * @property bool $hidden
 * @property int $id
 * @property string $type
 * @property-read User|null $user
 * @property int|null $user_id
 * @method static Builder visibleForUser(User|null $user)
 */
class UserGroupEvent extends Model
{
    use WithDbCursorHelper;

    const DEFAULT_SORT = 'id_desc';
    const SORTS = [
        'id_asc' => [
            ['column' => 'id', 'order' => 'ASC'],
        ],
        'id_desc' => [
            ['column' => 'id', 'order' => 'DESC'],
        ],
    ];

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

    public static function logGroupAdd(?User $actor, Group $group): void
    {
        static::log($actor, static::GROUP_ADD, null, $group);
    }

    public static function logGroupRemove(?User $actor, Group $group): void
    {
        static::log($actor, static::GROUP_REMOVE, null, $group);
    }

    public static function logGroupRename(?User $actor, Group $group, string $previousName, string $name): void
    {
        static::log($actor, static::GROUP_RENAME, null, $group, [
            'details' => [
                'group_name' => $name,
                'previous_group_name' => $previousName,
            ],
        ]);
    }

    public static function logUserAdd(?User $actor, User $user, Group $group, ?array $playmodes = null): void
    {
        // Never log additions to the default group
        if ($group->identifier === 'default') {
            return;
        }

        if (empty($playmodes)) {
            $playmodes = null;
        }

        static::log($actor, static::USER_ADD, $user, $group, [
            'details' => compact('playmodes'),
        ]);
    }

    public static function logUserAddPlaymodes(?User $actor, User $user, Group $group, array $playmodes): void
    {
        if (empty($playmodes)) {
            throw new InvariantException(__FUNCTION__.' called with no playmodes');
        }

        static::log($actor, static::USER_ADD_PLAYMODES, $user, $group, [
            'details' => compact('playmodes'),
        ]);
    }

    public static function logUserRemove(?User $actor, User $user, Group $group): void
    {
        static::log($actor, static::USER_REMOVE, $user, $group);
    }

    public static function logUserRemovePlaymodes(?User $actor, User $user, Group $group, array $playmodes): void
    {
        if (empty($playmodes)) {
            throw new InvariantException(__FUNCTION__.' called with no playmodes');
        }

        static::log($actor, static::USER_REMOVE_PLAYMODES, $user, $group, [
            'details' => compact('playmodes'),
        ]);
    }

    public static function logUserSetDefault(?User $actor, User $user, Group $group): void
    {
        static::log($actor, static::USER_SET_DEFAULT, $user, $group);
    }

    private static function log(?User $actor, string $type, ?User $user, Group $group, array $attributes = []): void
    {
        $attributes['details'] = array_merge(
            [
                'actor_name' => $actor?->username,
                'group_name' => $group->group_name,
                'user_name' => $user?->username,
            ],
            $attributes['details'] ?? [],
        );

        $event = static::create(array_merge(
            [
                'actor_id' => $actor?->getKey(),
                'group_id' => $group->getKey(),
                'hidden' => !$group->hasListing(),
                'type' => $type,
                'user_id' => $user?->getKey(),
            ],
            $attributes,
        ));

        if (!$event->exists) {
            throw new ModelNotSavedException('Failed to save model');
        }
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeVisibleForUser(Builder $query, ?User $user): void
    {
        if (priv_check_user($user, 'UserGroupEventShowAll')->can()) {
            return;
        }

        $userGroupIds = priv_check_user($user, 'IsSpecialScope')->can()
            ? $user->groupIds()['active']
            : [];

        $query->where('hidden', false);

        if (!empty($userGroupIds)) {
            $query->orWhereIn('group_id', $userGroupIds);
        }
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'actor_id',
            'group_id',
            'id',
            'type',
            'user_id' => $this->getRawAttribute($key),

            'details' => json_decode($this->getRawAttribute($key), true),

            'hidden' => (bool) $this->getRawAttribute($key),

            'created_at' => $this->getTimeFast($key),

            'created_at_json' => $this->getJsonTimeFast($key),

            'actor',
            'user' => $this->getRelationValue($key),

            'group' => app('groups')->byIdOrFail($this->getRawAttribute('group_id')),
        };
    }
}
