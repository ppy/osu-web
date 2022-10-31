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
    public $timestamps = false;
    public $incrementing = false;

    protected $casts = [
        'user_pending' => 'boolean',
    ];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'group_id'];
    protected $table = 'phpbb_user_group';

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setPlaymodesAttribute(?array $value): void
    {
        $this->attributes['playmodes'] = $this->group->has_playmodes ? json_encode($value ?? []) : null;
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'group_id',
            'user_id' => $this->getRawAttribute($key),

            'group_leader',
            'user_pending' => (bool) $this->getRawAttribute($key),

            'group' => app('groups')->byIdOrFail($this->group_id),
            'playmodes' => $this->getPlaymodes(),

            'user' => $this->getRelationValue($key),
        };
    }

    private function getPlaymodes(): ?array
    {
        if ($this->group->has_playmodes) {
            $value = $this->getRawAttribute('playmodes');

            return $value === null ? [] : json_decode($value, true);
        }

        return null;
    }
}
