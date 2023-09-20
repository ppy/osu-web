<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;

/**
 * @property User $actor
 * @property int $ban_id
 * @property int|null $ban_status
 * @property int|null $banner_id
 * @property int $period
 * @property bool $permanent
 * @property string|null $reason
 * @property string|null $supporting_url
 * @property \Carbon\Carbon|null $timestamp
 * @property mixed $type
 * @property User $user
 * @property int|null $user_id
 */
class UserAccountHistory extends Model
{
    const TYPES = [
        'note' => 0,
        'restriction' => 1,
        'silence' => 2,
        'tournament_ban' => 3,
    ];

    public $timestamps = false;

    protected $casts = [
        'permanent' => 'boolean',
        'timestamp' => 'datetime',
    ];
    protected $primaryKey = 'ban_id';
    protected $table = 'osu_user_banhistory';

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
        return $query->whereIn('ban_status', [static::TYPES['restriction'], static::TYPES['silence']])->orderBy('timestamp', 'desc');
    }

    public function scopeDefault($query)
    {
        return $query->whereIn('ban_status', [static::TYPES['silence'], static::TYPES['tournament_ban']]);
    }

    public function scopeRecent($query)
    {
        return $query
            ->where('timestamp', '>', Carbon::now()->subDays(config('osu.user.ban_persist_days')))
            ->orWhere('permanent', true)
            ->orderBy('timestamp', 'desc');
    }

    public function scopeRecentForChat($query)
    {
        return $query->where('timestamp', '>', Carbon::now()->subHours(1));
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
