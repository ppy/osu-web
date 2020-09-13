<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property array|null $details
 * @property Group $group
 * @property int $group_id
 * @property bool $hidden
 * @property int $id
 * @property \Carbon\Carbon $timestamp
 * @property string $type
 * @property User $user
 * @property int|null $user_id
 */
class UserGroupEvent extends Model
{
    const GROUP_ADD = 'group_add';
    const GROUP_REMOVE = 'group_remove';
    const GROUP_RENAME = 'group_rename';
    const USER_ADD = 'user_add';
    const USER_REMOVE = 'user_remove';

    protected $casts = [
        'details' => 'array',
        'hidden' => 'boolean',
    ];
    protected $dates = ['timestamp'];

    public $timestamps = false;

    public static function log(string $type, Group $group, ?User $user = null, ?array $details = null): self
    {
        return static::create([
            'details' => $details,
            'group_id' => $group->getKey(),
            'hidden' => !$group->isVisible(),
            'type' => $type,
            'user_id' => optional($user)->getKey(),
        ]);
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
