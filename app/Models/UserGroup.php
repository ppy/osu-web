<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Group $group
 * @property int $group_id
 * @property int $group_leader
 * @property User $user
 * @property int $user_id
 * @property int $user_pending
 * @property array|null $playmodes
 */
class UserGroup extends Model
{
    protected $table = 'phpbb_user_group';
    public $timestamps = false;
    protected $primaryKeys = ['user_id', 'group_id'];
    protected $casts = [
        'user_pending' => 'boolean',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getGroupAttribute(): Group
    {
        return app('groups')->byIdOrFail($this->group_id);
    }

    public function getPlaymodesAttribute(?string $value): ?array
    {
        return $this->group->has_playmodes ? (json_decode($value) ?? []) : null;
    }

    public function setPlaymodesAttribute(?array $value): void
    {
        $this->attributes['playmodes'] = $this->group->has_playmodes ? json_encode($value ?? []) : null;
    }
}
