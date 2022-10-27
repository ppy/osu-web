<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use DB;

/**
 * @property bool $foe
 * @property bool $friend
 * @property User $target
 * @property User $user
 * @property int $user_id
 * @property int $zebra_id
 */
class UserRelation extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'foe' => 'boolean',
        'friend' => 'boolean',
    ];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'zebra_id'];
    protected $table = 'phpbb_zebra';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'zebra_id', 'user_id');
    }

    public function scopeBlocks($query)
    {
        return $query->where('foe', true)->visible();
    }

    public function scopeFriends($query)
    {
        return $query->where('friend', true)->visible();
    }

    public function scopeOnline($query)
    {
        return $query->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('phpbb_users')
                ->whereRaw('phpbb_users.user_id = phpbb_zebra.zebra_id')
                ->whereRaw('phpbb_users.user_lastvisit > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL '.config('osu.user.online_window').' MINUTE))');
        });
    }

    public function scopeVisible($query)
    {
        $query->whereHas('target', function ($q) {
            $q->default();
        });
    }

    public function scopeWithMutual($query)
    {
        $selfJoin =
            'COALESCE((
                SELECT 1
                FROM phpbb_zebra z
                WHERE phpbb_zebra.zebra_id = z.user_id
                AND z.zebra_id = phpbb_zebra.user_id
                AND z.friend = 1
            ), 0)';

        if (count(config('osu.user.super_friendly')) > 0) {
            $friendlyIds = implode(',', config('osu.user.super_friendly'));
            $raw = DB::raw(
                "CASE WHEN phpbb_zebra.zebra_id IN ({$friendlyIds})
                    THEN 1
                ELSE
                    {$selfJoin}
                END as mutual"
            );
        } else {
            $raw = DB::raw("{$selfJoin} as mutual");
        }

        return $query->addSelect('*', $raw);
    }

    public function scopeWithOnline($query)
    {
        return $query->addSelect(DB::raw(
            '(
                SELECT phpbb_users.user_lastvisit > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL '.config('osu.user.online_window').' MINUTE))
                FROM phpbb_users
                WHERE phpbb_users.user_id = phpbb_zebra.zebra_id
            ) as online'
        ));
    }
}
