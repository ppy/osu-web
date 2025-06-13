<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\ContestJudgeVote;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;

class ContestJudgeVoteTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'scores',
        'total_score_std',
        'total_score',
        'user',
    ];

    public function transform(ContestJudgeVote $judgeVote): array
    {
        return [
            'comment' => $judgeVote->comment,
            'id' => $judgeVote->getKey(),
        ];
    }

    public function includeScores(ContestJudgeVote $judgeVote): Collection
    {
        return $this->collection($judgeVote->scores, new ContestJudgeScoreTransformer());
    }

    public function includeTotalScore(ContestJudgeVote $judgeVote): Primitive
    {
        return $this->primitive($judgeVote->totalScore());
    }

    public function includeTotalScoreStd(ContestJudgeVote $judgeVote): Primitive
    {
        return $this->primitive($judgeVote->total_score_std);
    }

    public function includeUser(ContestJudgeVote $judgeVote): Item
    {
        return $this->item($judgeVote->user, new UserCompactTransformer());
    }
}
