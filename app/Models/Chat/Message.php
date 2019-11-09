<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models\Chat;

use App\Models\User;

/**
 * @property Channel $channel
 * @property int $channel_id
 * @property string $content
 * @property bool $is_action
 * @property int $message_id
 * @property User $sender
 * @property \Carbon\Carbon $timestamp
 * @property int $user_id
 */
class Message extends Model
{
    protected $primaryKey = 'message_id';
    protected $casts = [
        'is_action' => 'boolean',
    ];
    protected $dates = [
        'timestamp',
    ];
    protected $guarded = [];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeForUser($query, User $user)
    {
        $channelIds = UserChannel::where([
            'user_id' => $user->user_id,
            'hidden' => false,
        ])->pluck('channel_id');

        return $query->whereIn('channel_id', $channelIds)
            ->orderBy('message_id', 'desc');
    }

    public function scopeSince($query, $messageId)
    {
        return $query->where('message_id', '>', $messageId);
    }
}
