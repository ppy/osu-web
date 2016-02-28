<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlackUser extends Model
{
    protected $table = 'osu_slack_users';
    protected $primaryKey = 'slack_id';

    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['created_at'];
}
