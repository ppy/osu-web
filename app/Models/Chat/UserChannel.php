<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Libraries\Notification\BatchIdentities;
use App\Models\User;
use App\Models\UserNotification;
use DB;

/**
 * @property Channel $channel
 * @property int $channel_id
 * @property bool $hidden
 * @property int|null $last_read_id
 * @property User $user
 * @property User $userScoped
 * @property int $user_id
 */
class UserChannel extends Model
{
    protected $primaryKeys = ['user_id', 'channel_id'];

    private ?int $lastReadIdToSet;

    public function getLastReadIdAttribute($value): ?int
    {
        // return the value we tried to set it to, not the builder.
        return $this->lastReadIdToSet ?? $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userScoped()
    {
        return $this->belongsTo(User::class, 'user_id')->default();
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    // Laravel has own hidden property
    public function isHidden()
    {
        return (bool) $this->getAttribute('hidden');
    }

    public function markAsRead($messageId = null)
    {
        $this->lastReadIdToSet = get_int($messageId ?? Message::where('channel_id', $this->channel_id)->max('message_id'));

        if ($this->lastReadIdToSet === null) {
            return;
        }

        // this prevents the read marker from going backwards
        $this->update(['last_read_id' => DB::raw("GREATEST(COALESCE(last_read_id, 0), $this->lastReadIdToSet)")]);

        UserNotification::batchMarkAsRead($this->user, BatchIdentities::fromParams([
            'identities' => [
                [
                    'category' => 'channel',
                    'object_type' => 'channel',
                    'object_id' => $this->channel_id,
                ],
            ],
        ]));
    }
}
