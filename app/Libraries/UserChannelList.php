<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use Ds\Map;
use Ds\Set;
use Illuminate\Support\Collection;

class UserChannelList
{
    private Collection $channels;

    public function __construct(private User $user)
    {
    }

    public function get()
    {
        $this->loadChannels();
        $this->preloadUsers();

        $filteredChannels = $this->channels->filter(fn (Channel $channel) => $channel->isVisibleFor($this->user));

        $transformer = ChannelTransformer::forUser($this->user);

        return json_collection($filteredChannels, $transformer, ['current_user_attributes', 'last_message_id', 'last_read_id', 'users']);
    }

    private function loadChannels()
    {
        $userChannels = UserChannel::where('user_id', $this->user->getKey())
            ->where('hidden', false)
            ->whereHas('channel')
            ->with('channel')
            ->limit(config('osu.chat.channel_limit'))
            ->get();

        foreach ($userChannels as $userChannel) {
            // preset userChannel for getting last_read_id.
            $userChannel->channel->setUserChannel($userChannel);
        }

        $this->channels = $userChannels->pluck('channel');
    }

    private function preloadUsers()
    {
        // Getting user list; Limited to PM channels due to large size of public channels.
        $userPmChannels = UserChannel::whereIn('channel_id', $this->channels->pluck('channel_id'))
            ->whereHas('channel', fn ($q) => $q->where('type', 'PM'))
            ->get();

        $userIds = (new Set($userPmChannels->pluck('user_id')))->toArray();

        $users = User::default()
            ->whereIn('user_id', $userIds)
            ->with([
                // only fetch data related to $user, to be used by ChatPmStart/ChatChannelCanMessage privilege check
                'friends' => fn ($query) => $query->where('zebra_id', $this->user->getKey()),
                'blocks' => fn ($query) => $query->where('zebra_id', $this->user->getKey()),
            ])
            ->get();

        // If any channel users are blocked, preload the user groups of those users for the isModerator check.
        $blockedIds = $users->pluck('user_id')->intersect($this->user->blocks->pluck('user_id'));
        if ($blockedIds->isNotEmpty()) {
            // Yes, the sql will look stupid.
            $users->load(['userGroups' => fn ($query) => $query->whereIn('user_id', $blockedIds)]);
        }

        $usersMap = new Map();
        foreach ($users as $user) {
            $usersMap->put($user->getKey(), $user);
        }

        request()->attributes->set(Channel::PRELOADED_USERS_KEY, $usersMap);
    }
}
