<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\Country;
use League\Fractal;

class CountryTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = ['ranking'];

    public function transform(Country $country = null)
    {
        return [
            'code' => $country->acronym ?? null,
            'name' => $country->name ?? null,
        ];
    }

    public function includeRanking(Country $country)
    {
        return $this->item($country, function ($country) {
            return [
              'active_users' => $country->usercount,
              'play_count' => $country->playcount,
              'ranked_score' => $country->rankedscore,
              'performance' => $country->pp,
            ];
        });
    }
}
