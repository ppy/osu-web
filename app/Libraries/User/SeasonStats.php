<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\Season;
use App\Models\User;
use App\Transformers\SeasonDivisionTransformer;
use App\Transformers\SeasonTransformer;

class SeasonStats
{
    public function __construct(
        public User $user,
        public Season $season,
    ) {
    }

    public function calculate(): ?array
    {
        $score = $this->season->userScores()
            ->whereBelongsTo($this->user)
            ->first();

        if ($score === null) {
            return null;
        }

        $rank = $this->season->userScores()
            ->whereHas('user', fn ($q) => $q->default())
            ->where('total_score', '>', $score->total_score)
            ->count() + 1;

        foreach ($this->season->divisionsWithMaxRanks() as $division) {
            if ($rank <= $division['max_rank']) {
                $userDivision = $division['division'];
                break;
            }
        }

        if (!isset($userDivision)) {
            return null;
        }

        return [
            'division' => json_item($userDivision, new SeasonDivisionTransformer()),
            'rank' => $rank,
            'season' => json_item($this->season, new SeasonTransformer()),
            'total_score' => $score->total_score,
        ];
    }

    public function get(): ?array
    {
        return null_if_false(
            \Cache::remember(
                $this->seasonCacheKey(),
                600,
                fn () => $this->calculate() ?? false,
            ),
        );
    }

    public function resetCache(): bool
    {
        return \Cache::forget($this->seasonCacheKey());
    }

    private function seasonCacheKey(): string
    {
        return "season_stats:{$this->user->getKey()}:{$this->season->getKey()}";
    }
}
