<?php

namespace App\Models;

class UserRelation extends Model
{
    protected $table = 'phpbb_zebra';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'zebra_id', 'user_id');
    }
}
