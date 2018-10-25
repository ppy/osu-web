<?php

namespace App\Models;

use DB;

class UserRelation extends Model
{
    protected $table = 'phpbb_zebra';
    public $timestamps = false;
    protected $casts = [
        'friend' => 'boolean',
        'foe' => 'boolean',
    ];

    protected $primaryKeys = ['user_id', 'zebra_id'];

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
        return $query->where('foe', true);
    }

    public function scopeFriends($query)
    {
        return $query->where('friend', true);
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
