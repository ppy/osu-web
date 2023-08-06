<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\ContestJudgeCategoryVote;
use League\Fractal\Resource\Item;

class ContestJudgeCategoryVoteTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'category',
    ];

    public function transform(ContestJudgeCategoryVote $categoryVote): array
    {
        return [
            'contest_judge_category_id' => $categoryVote->contest_judge_category_id,
            'id' => $categoryVote->getKey(),
            'value' => $categoryVote->value,
        ];
    }

    public function includeCategory(ContestJudgeCategoryVote $categoryVote): Item
    {
        return $this->item($categoryVote->category, new ContestJudgeCategoryTransformer());
    }
}
