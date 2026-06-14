<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Multiplayer\Room $room
 * @property int $room_id
 * @property MatchmakingPool $pool
 * @property int $pool_id
 * @property User $user
 * @property int $user_id
 * @property User $opponent
 * @property int $opponent_id
 * @property string $result
 * @property int $elo_before
 * @property int $elo_after
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class MatchmakingUserEloHistory extends Model
{
    protected $table = 'matchmaking_user_elo_history';

    public function opponent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'opponent_id');
    }

    public function pool(): BelongsTo
    {
        return $this->belongsTo(MatchmakingPool::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Multiplayer\Room::class, 'room_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
