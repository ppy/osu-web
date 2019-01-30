<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Multiplayer;

use App\Models\Model;
use App\Models\User;

/**
 * Dumb persistence model for UserScoreAggregate.
 *
 * @property float $accuracy
 * @property int $attempts
 * @property int $completed
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property float|null $pp
 * @property Room $room
 * @property int $room_id
 * @property int $total_score
 * @property \Carbon\Carbon $updated_at
 * @property User $user
 * @property int $user_id
 */
class RoomUserHighScore extends Model
{
    protected $table = 'multiplayer_rooms_high';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
