<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBeatmapsetRating extends Model
{
    protected $table = 'osu_user_beatmapset_ratings';

    public $timestamps = false;

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
