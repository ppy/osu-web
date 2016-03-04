<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlackUser extends Model
{
    protected $table = 'osu_slack_users';
    protected $primaryKey = 'user_id';

    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
