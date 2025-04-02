<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\SeasonDivision;

class SeasonDivisionTransformer extends TransformerAbstract
{
    public function transform(SeasonDivision $division): array
    {
        return [
            'colour_tier' => $division->colour_tier,
            'id' => $division->getKey(),
            'image_url' => $division->image_url,
            'name' => $division->name,
            'threshold' => $division->threshold,
        ];
    }
}
