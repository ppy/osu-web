<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Country;

class CountryTransformer extends TransformerAbstract
{
    public function transform(Country $country)
    {
        return [
            'code' => $country->acronym,
            'name' => $country->name,
        ];
    }
}
