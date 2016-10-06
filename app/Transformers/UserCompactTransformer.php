<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Transformers;

use App\Models\User;
use League\Fractal;

class UserCompactTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'country',
    ];

    public function transform(User $user)
    {
        $profileCustomization = $user->profileCustomization()->firstOrNew([]);

        return [
            'id' => $user->user_id,
            'username' => $user->username,
            'avatarUrl' => $profileCustomization->avatar->url(),
            'country' => $user->country_acronym,
        ];
    }

    public function includeCountry(User $user)
    {
        return $this->item($user->country, new CountryTransformer);
    }
}
