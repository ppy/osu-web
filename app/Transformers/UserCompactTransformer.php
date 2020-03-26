<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\User;

class UserCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'country',
        'cover',
        'current_mode_rank',
        'group_badge',
        'support_level',
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->user_id,
            'username' => $user->username,
            'profile_colour' => $user->user_colour,
            'avatar_url' => $user->user_avatar,
            'country_code' => $user->country_acronym,
            'default_group' => $user->defaultGroup()->identifier,
            'is_active' => $user->isActive(),
            'is_bot' => $user->isBot(),
            'is_online' => $user->isOnline(),
            'is_supporter' => $user->isSupporter(),
            'last_visit' => json_time($user->displayed_last_visit),
            'pm_friends_only' => $user->pm_friends_only,
        ];
    }

    public function includeCountry(User $user)
    {
        return $user->country === null
            ? $this->primitive(null)
            : $this->item($user->country, new CountryTransformer);
    }

    public function includeCover(User $user)
    {
        $profileCustomization = $user->userProfileCustomization;

        return $this->primitive([
            'custom_url' => $profileCustomization ? $profileCustomization->cover()->fileUrl() : null,
            'url' => $profileCustomization ? $profileCustomization->cover()->url() : null,
            'id' => $profileCustomization ? $profileCustomization->cover()->id() : null,
        ]);
    }

    public function includeCurrentModeRank(User $user)
    {
        $currentModeStatistics = $user->statistics(auth()->user()->playmode ?? 'osu');

        return $this->primitive($currentModeStatistics ? $currentModeStatistics->globalRank() : null);
    }

    public function includeGroupBadge(User $user)
    {
        $badge = $user->groupBadge();

        if (isset($badge)) {
            return $this->item($badge, new GroupTransformer);
        }
    }

    public function includeSupportLevel(User $user)
    {
        return $this->primitive($user->supportLevel());
    }
}
