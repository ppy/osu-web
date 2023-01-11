<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Libraries\Notification\BatchIdentities;
use App\Models\User;
use App\Models\UserNotification;
use DB;
use Illuminate\Database\Query\Expression;

/**
 * @property Channel $channel
 * @property int $channel_id
 * @property int|null $last_read_id
 * @property User $user
 * @property int $user_id
 */
class UserChannel extends Model
{
    protected $primaryKeys = ['user_id', 'channel_id'];

    private ?int $lastReadIdToSet;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'channel_id',
            'user_id' => $this->getRawAttribute($key),

            'last_read_id' => $this->getLastReadId(),

            'channel',
            'user' => $this->getRelationValue($key),
        };
    }

    // Laravel has own hidden property
    // TODO: https://github.com/ppy/osu-web/pull/9486#discussion_r1017831112
    public function isHidden()
    {
        return (bool) $this->getRawAttribute('hidden');
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

    private function getLastReadId(): ?int
    {
        $value = $this->getRawAttribute('last_read_id');

        // return the value we tried to set it to, not the query expression.
        return $value instanceof Expression ? $this->lastReadIdToSet : $value;
    }
}
