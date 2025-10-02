<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Multiplayer;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property array|null $event_detail
 * @property string $event_type
 * @property int $id
 * @property Room $room
 * @property int $room_id
 * @property PlaylistItem|null $playlistItem
 * @property int|null $playlist_item_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User|null $user
 * @property int|null $user_id
 */
class RealtimeRoomEvent extends Model
{
    const EVENT_TYPES = [
        'game_started',
        'game_aborted',
        'game_completed',
        'host_changed',
        'player_joined',
        'player_kicked',
        'player_left',
        'room_created',
        'room_disbanded',
    ];

    protected $table = 'multiplayer_realtime_room_events';

    protected $casts = [
        'event_detail' => 'array',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function playlistItem()
    {
        return $this->belongsTo(PlaylistItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterValidPlaylistItemId(Builder $query): Builder
    {
        return $query
            ->whereNull('playlist_item_id')
            ->orHas('playlistItem');
    }
}
