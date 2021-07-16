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
        'is_silenced',
    ];

    public function transform(User $user)
    {
        $result = parent::transform($user);

        $profileCustomization = $this->userProfileCustomization($user);

        return array_merge($result, [
            'cover_url' => $profileCustomization->cover()->url(), // TODO: deprecated.
            'discord' => $user->user_discord,
            'has_supported' => $user->hasSupported(),
            'interests' => $user->user_interests,
            'join_date' => json_time($user->user_regdate),
            'kudosu' => [
                'total' => $user->osu_kudostotal,
                'available' => $user->osu_kudosavailable,
            ],
            'location' => $user->user_from,
            'max_blocks' => $user->maxBlocks(),
            'max_friends' => $user->maxFriends(),
            'occupation' => $user->user_occ,
            'playmode' => $user->playmode,
            'playstyle' => $user->osu_playstyle,
            'post_count' => $user->user_posts,
            'profile_order' => $profileCustomization->extras_order,
            'title' => $user->title(),
            'title_url' => $user->titleUrl(),
            'twitter' => $user->user_twitter,
            'website' => $user->user_website,
        ]);
    }
}
