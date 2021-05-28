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
        'playmodes' => 'array',
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
        return app('groups')->byId($this->group_id);
    }

    /**
     * @param array|string|null $value
     */
    public function getPlaymodesAttribute($value): ?array
    {
        if ($this->group->has_playmodes) {
            if (is_array($value)) {
                return $value;
            }

            if (is_string($value)) {
                return json_decode($value);
            }

            return [];
        }

        return null;
    }
}
