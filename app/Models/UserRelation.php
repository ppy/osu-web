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

    public function scopeWithMutual($query)
    {
        return $query->addSelect(
            '*',
            DB::raw('COALESCE((
                SELECT 1
                FROM phpbb_zebra z
                WHERE phpbb_zebra.zebra_id = z.user_id
                AND z.zebra_id = phpbb_zebra.user_id
                AND z.friend = 1
            ), 0) as mutual')
        );
    }
}
