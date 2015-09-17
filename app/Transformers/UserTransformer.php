<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Transformers;

use App\Models\Achievement;
use App\Models\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'defaultStatistics',
    ];

    public function transform(User $user)
    {
        $profileCustomization = $user->profileCustomization()->firstOrNew([]);

        return [
            'id' => $user->user_id,
            'username' => $user->username,
            'joinDate' => display_regdate($user),
            'country' => [
                'code' => $user->country_acronym,
                'name' => $user->countryName(),
            ],
            'age' => $user->age,
            'avatarUrl' => $user->user_avatar,
            'isAdmin' => $user->is_admin,
            'isSupporter' => $user->osu_subscriber,
            'title' => $user->title(),
            'location' => $user->user_from,
            'lastvisit' => $user->user_lastvisit->toIso8601String(),
            'twitter' => $user->user_twitter,
            'lastfm' => $user->user_lastfm,
            'skype' => $user->user_msnm,
            'playstyle' => $user->osu_playstyle,
            'playmode' => $user->playmode,
            'cover' => [
                'customUrl' => $profileCustomization->cover->customUrl(),
                'url' => $profileCustomization->cover->url(),
                'id' => $profileCustomization->cover->id(),
            ],
            'achievements' => [
                'total' => Achievement::count(),
                'current' => $user->achievements()->count(),
            ],
        ];
    }

    public function includeDefaultStatistics(User $user)
    {
        $stats = $user->statistics($user->playmode);

        return $this->item($stats, new UserStatisticsTransformer());
    }
}
