<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Country;

class CountryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'display',
        'ranking',
    ];

    public function transform(Country $country)
    {
        return [
            'code' => $country->acronym,
            'name' => $country->name,
        ];
    }

    public function includeDisplay(Country $country)
    {
        return $this->primitive($country->display);
    }

    public function includeRanking(Country $country)
    {
        return $this->primitive([
            'active_users' => $country->usercount,
            'play_count' => $country->playcount,
            'ranked_score' => $country->rankedscore,
            'performance' => $country->pp,
        ]);
    }
}
