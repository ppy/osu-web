<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\ContestScoringCategory;

class ContestScoringCategoryTransformer extends TransformerAbstract
{
    public function transform(ContestScoringCategory $scoringCategory): array
    {
        return [
            'description' => $scoringCategory->description,
            'id' => $scoringCategory->getKey(),
            'max_value' => $scoringCategory->max_value,
            'name' => $scoringCategory->name,
        ];
    }
}
