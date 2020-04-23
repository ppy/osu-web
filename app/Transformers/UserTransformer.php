<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\User;

class UserTransformer extends UserCompactTransformer
{
    protected $defaultIncludes = [
        'country',
        'cover',
        'is_admin',
        'is_bng',
        'is_full_bn',
        'is_gmt',
        'is_limited_bn',
        'is_moderator',
        'is_nat',
        'is_restricted',
    ];

    public function transform(User $user)
    {
        $result = parent::transform($user);

        $profileCustomization = $this->userProfileCustomization($user);

        return array_merge($result, [
            'cover_url' => $profileCustomization->cover()->url(),
            'discord' => $user->user_discord,
            'has_supported' => $user->hasSupported(),
            'interests' => $user->user_interests,
            'join_date' => json_time($user->user_regdate),
            'kudosu' => [
                'total' => $user->osu_kudostotal,
                'available' => $user->osu_kudosavailable,
            ],
            'last_visit' => json_time($user->displayed_last_visit),
            'lastfm' => $user->user_lastfm,
            'location' => $user->user_from,
            'is_online' => $user->isOnline(),
            'max_blocks' => $user->maxBlocks(),
            'max_friends' => $user->maxFriends(),
            'occupation' => $user->user_occ,
            'playmode' => $user->playmode,
            'playstyle' => $user->osu_playstyle,
            'pm_friends_only' => $user->pm_friends_only,
            'post_count' => $user->user_posts,
            'profile_colour' => $user->user_colour,
            'profile_order' => $profileCustomization->extras_order,
            'skype' => $user->user_msnm,
            'title' => $user->title(),
            'twitter' => $user->user_twitter,
            'website' => $user->user_website,
        ]);
    }
}
