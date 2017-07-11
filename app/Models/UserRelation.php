<?php

namespace App\Models;

use DB;

class UserRelation extends Model
{
    protected $table = 'phpbb_zebra';
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'zebra_id', 'user_id');
    }

    public function scopeFriends($query)
    {
        return $query->where('friend', true);
    }

    public function scopeWithMutual($query)
    {
        $selfJoin = 'COALESCE((
                    SELECT 1
                    FROM phpbb_zebra z
                    WHERE phpbb_zebra.zebra_id = z.user_id
                    AND z.zebra_id = phpbb_zebra.user_id
                    AND z.friend = 1
                ), 0)';

        if (count(config('osu.user.super_friendly') > 0)) {
            $friendlyIds = join(',', config('osu.user.super_friendly'));
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
        return $query->addSelect(DB::raw('(SELECT phpbb_users.user_lastvisit > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 MINUTE)) FROM phpbb_users WHERE phpbb_users.user_id = phpbb_zebra.zebra_id) as online'));
    }
}
