<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\User;
use App\Models\UserProfileCustomization;

class UserTransformer extends UserCompactTransformer
{
    protected array $defaultIncludes = [
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
        'kudosu',
    ];

    public function transform(User $user)
    {
        $result = parent::transform($user);

        $profileOrder = UserProfileCustomization::forUser($user)['extras_order'];

        return [
            ...$result,
            'cover_url' => $user->cover()->url(), // TODO: deprecated.
            'discord' => $user->user_discord,
            'has_supported' => $user->hasSupported(),
            'interests' => $user->user_interests,
            'join_date' => json_time($user->user_regdate),
            'location' => $user->user_from,
            'max_blocks' => $user->maxBlocks(),
            'max_friends' => $user->maxFriends(),
            'occupation' => $user->user_occ,
            'playmode' => $user->playmode,
            'playstyle' => $user->osu_playstyle,
            'post_count' => $user->user_posts,
            'profile_hue' => $user->user_style,
            'profile_order' => $profileOrder,
            'title' => $user->title(),
            'title_url' => $user->titleUrl(),
            'twitter' => $user->user_twitter,
            'website' => $user->user_website,
        ];
    }
}
