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
 * @property User $actor
 * @property int $ban_id
 * @property int|null $ban_status
 * @property int|null $banner_id
 * @property int $period
 * @property string|null $reason
 * @property string|null $supporting_url
 * @property \Carbon\Carbon|null $timestamp
 * @property mixed $type
 * @property User $user
 * @property int|null $user_id
 */
class UserAccountHistory extends Model
{
    protected $table = 'osu_user_banhistory';
    protected $primaryKey = 'ban_id';

    protected $dates = ['timestamp'];
    public $timestamps = false;

    const TYPES = [
        'note' => 0,
        'restriction' => 1,
        'silence' => 2,
    ];

    public static function addNote($user, $message, $actor = null)
    {
        $actor = $actor ?? $user;

        return static::create([
            'user_id' => $user->getKey(),
            'banner_id' => $actor->getKey(),

            'ban_status' => static::TYPES['note'],

            'reason' => $message,
        ]);
    }

    public static function logUserPageModerated($user, $actor)
    {
        return static::addNote($user, 'User page moderated', $actor);
    }

    public static function logUserResetPassword($user)
    {
        return static::addNote($user, 'User forgot and recovered their password.');
    }

    public static function logUserUpdateEmail($user, $previousEmail)
    {
        $previousEmail = $previousEmail ?? 'null';
        $message = "User changed email from {$previousEmail} to {$user->user_email}";

        return static::addNote($user, $message);
    }

    public function scopeBans($query)
    {
        return $query->where('ban_status', '<>', static::TYPES['note'])->orderBy('timestamp', 'desc');
    }

    public function scopeDefault($query)
    {
        return $query->where('ban_status', static::TYPES['silence']);
    }

    public function scopeRecent($query)
    {
        return $query
            ->where('timestamp', '>', Carbon::now()->subDays(config('osu.user.ban_persist_days')))
            ->orderBy('timestamp', 'desc');
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'banner_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function getTypeAttribute()
    {
        return array_search_null($this->ban_status, static::TYPES);
    }

    public function endTime()
    {
        return $this->timestamp->addSeconds($this->period);
    }
}
