<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Season;

class SeasonTransformer extends TransformerAbstract
{
    public function transform(Season $season)
    {
        return [
            'id' => $season->id,
            'name' => $season->name,
        ];
    }
}
