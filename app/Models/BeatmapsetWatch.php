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
