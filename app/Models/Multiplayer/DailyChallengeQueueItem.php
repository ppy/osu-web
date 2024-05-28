<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Models\Beatmap;
use App\Models\Model;

/**
 * @property json|null $allowed_mods
 * @property int $beatmap_id
 * @property int|null $multiplayer_room_id
 * @property int|null $order
 * @property json|null $required_mods
 * @property int $ruleset_id
 */
class DailyChallengeQueueItem extends Model
{
    public $timestamps = false;

    protected $table = 'daily_challenge_queue';
    protected $casts = [
        'allowed_mods' => 'array',
        'required_mods' => 'array',
    ];

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id')->withTrashed();
    }

    public function multiplayerRoom()
    {
        return $this->belongsTo(Room::class);
    }
}
