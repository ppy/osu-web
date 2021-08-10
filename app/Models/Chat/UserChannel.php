<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Libraries\Notification\BatchIdentities;
use App\Models\User;
use App\Models\UserNotification;
use App\Transformers\Chat\ChannelTransformer;
use DB;
use Ds\Map;
use Ds\Set;

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

    public static function channelListForUser(User $user)
    {
        $userChannels = static::forUser($user)
            ->whereHas('channel')
            ->with('channel')
            ->get();

        $channels = $userChannels->pluck('channel');
        $channelsMap = new Map();
        foreach ($channels as $channel) {
            $channelsMap->put($channel->getKey(), $channel);
        }

        $pmUserIds = new Set(
            static::whereIn('channel_id', $userChannels->pluck('channel_id'))
                ->whereHas('channel', function ($q) {
                    $q->where('type', 'PM');
                })
                ->pluck('user_id')
        );

        $users = User::default()->whereIn('user_id', $pmUserIds->toArray())->get();
        $usersMap = new Map();
        foreach ($users as $user) {
            $usersMap->put($user->getKey(), $user);
        }

        request()->attributes->set('preloadedUsers', $usersMap);
        request()->attributes->set('preloadedChannels', $channelsMap);

        return $channels;
    }

    public static function presenceForUser(User $user)
    {
        // retrieve all the channels the user is in and thse metadata for each
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

        $userIdsUnique = [];
        foreach ($userPmChannels as $userPmChannel) {
            $userIdsUnique[$userPmChannel->user_id] = null;
        }

        static::preloadUsers(array_keys($userIdsUnique), $user);

        // End getting user list.

        $transformer = ChannelTransformer::forUser($user);

        $collection = json_collection($userChannels, function ($userChannel) use ($transformer) {
            $channel = $userChannel->channel;
            $presence = json_item($channel, $transformer, ['last_message_id', 'last_read_id', 'users']);
            // TODO:
            // hide if target is restricted or blocked unless blocked user is a moderator.
            // if (
            //     !$targetUser
            //     || $user->hasBlocked($targetUser) && !($targetUser->isModerator() || $targetUser->isAdmin())
            // ) {
            //     return [];
            // }
            // $presence['moderated'] = $presence['moderated'] || !priv_check_user($user, 'ChatStart', $targetUser)->can();

            return $presence;
        });

        // strip out the empty [] elements (from restricted/blocked users)
        return array_values(array_filter($collection));
    }

    private static function forUser(User $user)
    {
        return static::where('user_id', $user->getKey())->where('hidden', false);
    }

    private static function preloadUsers(array $userIds, User $user)
    {
        $users = User::default()
            ->whereIn('user_id', $userIds)
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

        $usersMap = new Map();
        foreach ($users as $user) {
            $usersMap->put($user->getKey(), $user);
        }

        request()->attributes->set('preloadedUsers', $usersMap);

        return $users;
    }
}
