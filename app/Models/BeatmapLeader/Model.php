<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\BeatmapLeader;

use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\User;

/**
 * @property Beatmap $beatmap
 * @property User $user
 */
abstract class Model extends BaseModel
{
    protected $primaryKey = 'beatmap_id';

    public $timestamps = false;

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    abstract public function score();
}
