<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property \Carbon\Carbon|null $last_notified
 * @property \Carbon\Carbon $last_read
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class BeatmapsetWatch extends Model
{
    protected $dates = ['last_read', 'last_notified'];

    public static function check($beatmapset, $user)
    {
        if ($beatmapset === null || $user === null) {
            return false;
        }

        return static
            ::where('beatmapset_id', '=', $beatmapset->getKey())
            ->where('user_id', '=', $user->getKey())
            ->exists();
    }

    public static function markRead($beatmapset, $user)
    {
        if ($beatmapset === null || $user === null) {
            return;
        }

        return static
            ::where('beatmapset_id', '=', $beatmapset->getKey())
            ->where('user_id', '=', $user->getKey())
            ->update(['last_read' => Carbon::now()]);
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeRead($query)
    {
        $query->where(function ($query) {
            $query
                ->whereColumn('last_read', '>=', 'last_notified')
                ->orWhereNull('last_notified');
        });
    }

    public function scopeUnread($query)
    {
        $query->whereColumn('last_read', '<', 'last_notified');
    }

    public function scopeVisible($query)
    {
        $query->whereHas('beatmapset', function ($q) {
            $q->active();
        });
    }

    public function isRead()
    {
        return $this->last_read >= $this->last_notified;
    }
}
