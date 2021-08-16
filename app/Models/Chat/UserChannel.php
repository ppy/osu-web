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
    protected $guarded = [];

    protected $primaryKeys = ['user_id', 'channel_id'];

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
        $maxId = get_int($messageId ?? Message::where('channel_id', $this->channel_id)->max('message_id'));

        if ($maxId === null) {
            return;
        }

        // this prevents the read marker from going backwards
        $this->update(['last_read_id' => DB::raw("GREATEST(COALESCE(last_read_id, 0), $maxId)")]);

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

    public static function presenceForUser(User $user)
    {
        // retrieve all the channels the user is in and the metadata for each
        $userChannels = static::forUser($user)
            ->whereHas('channel')
            ->with('channel')
            ->limit(config('osu.chat.channel_limit'))
            ->get();

        $channelIds = $userChannels->pluck('channel_id');

        // Getting user list; Limited to PM channels due to large size of public channels.
        // FIXME: Chat needs reworking so it doesn't need to preload all this extra data every update.
        $userPmChannels = static::whereIn('channel_id', $channelIds)
            ->whereHas('channel', function ($q) {
                $q->where('type', 'PM');
            })
            ->get();

        $userIdsByChannelId = [];
        $userIdsUnique = [];
        foreach ($userPmChannels as $userPmChannel) {
            $userIdsUnique[$userPmChannel->user_id] = null;
            $userIdsByChannelId[$userPmChannel->channel_id][] = $userPmChannel->user_id;
        }

        $users = User::default()
            ->whereIn('user_id', array_keys($userIdsUnique))
            ->with([
                // only fetch data related to $user, to be used by ChatStart privilege check
                'friends' => function ($query) use ($user) {
                    $query->where('zebra_id', $user->getKey());
                },
                'blocks' => function ($query) use ($user) {
                    $query->where('zebra_id', $user->getKey());
                },
            ])
            ->get();

        // If any channel users are blocked, preload the user groups of those users for the isModerator check.
        $blockedIds = $users->pluck('user_id')->intersect($user->blocks->pluck('user_id'));
        if ($blockedIds->isNotEmpty()) {
            // Yes, the sql will look stupid.
            $users->load(['userGroups' => function ($query) use ($blockedIds) {
                $query->whereIn('user_id', $blockedIds);
            }]);
        }

        $usersById = $users->keyBy('user_id');

        // End getting user list.

        $collection = json_collection($userChannels, function ($userChannel) use ($user, $userIdsByChannelId, $usersById) {
            $channel = $userChannel->channel;

            $presence = [
                'channel_id' => $channel->channel_id,
                'type' => $channel->type,
                'name' => $channel->name,
                'description' => presence($channel->description),
                'last_message_id' => $channel->last_message_id,
                'last_read_id' => $userChannel->last_read_id,
                'moderated' => $channel->moderated,
            ];

            $channelUserIds = [];
            // filter out restricted users from the listing
            // this says != PUBLIC but really is just == PM because of the data loaded.
            if ($channel->type !== Channel::TYPES['public']) {
                $userIds = $userIdsByChannelId[$channel->getKey()] ?? [];

                foreach ($userIds as $userId) {
                    if ($usersById[$userId] ?? null) {
                        $channelUserIds[] = $userId;
                    }
                }
            }

            $presence['users'] = $channelUserIds;

            if ($channel->isPM()) {
                // remove ourselves from $channelUserIds, leaving only the other party.
                // array_shift doesn't require array_values to be called first.
                $members = array_diff($channelUserIds, [$user->getKey()]);
                $targetUser = $usersById[array_shift($members)] ?? null;

                // hide if target is restricted or blocked unless blocked user is a moderator.
                if (
                    !$targetUser
                    || $user->hasBlocked($targetUser) && !($targetUser->isModerator() || $targetUser->isAdmin())
                ) {
                    return [];
                }

                // override channel icon and display name in PMs to always show the other party
                $presence['icon'] = $targetUser->user_avatar;
                $presence['name'] = $targetUser->username;
                // ideally this should be ChatChannelSend but it involves too many queries
                $presence['moderated'] = $presence['moderated'] || !priv_check_user($user, 'ChatStart', $targetUser)->can();
            }

            return $presence;
        });

        // strip out the empty [] elements (from restricted/blocked users)
        return array_values(array_filter($collection));
    }

    private static function forUser(User $user)
    {
        return static::where('user_id', $user->getKey())->where('hidden', false);
    }
}
