<?php

namespace App\Models;

class BeatmapsetUserRating extends Model
{
    protected $table = 'osu_user_beatmapset_ratings';

    public $timestamps = false;

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
