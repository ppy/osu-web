<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

/**
 * @property Group $group
 * @property int $group_id
 * @property int $group_leader
 * @property User $user
 * @property int $user_id
 * @property int $user_pending
 */
class UserGroup extends Model
{
    protected $table = 'phpbb_user_group';
    public $timestamps = false;
    protected $primaryKeys = ['user_id', 'group_id'];

    // taken from current forum
    const GROUPS = [
        'default' => 2,
        'gmt' => 4,
        'admin' => 5,
        'nat' => 7,
        'dev' => 11,
        'alumni' => 16,
        'mod' => 18,
        'bng' => 28,
        'bot' => 29,
        'loved' => 31,
        'bng_limited' => 32,
        'ppy' => 33,
    ];

    const DISPLAY_PRIORITY = [
        'ppy',
        'dev',
        'gmt',
        'nat',
        'bng',
        'bng_limited',
        'support',
        'alumni',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function name()
    {
        static $lookup;

        $lookup = $lookup ?? array_flip(static::GROUPS);

        return $lookup[$this->group_id] ?? null;
    }
}
