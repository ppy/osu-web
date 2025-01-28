<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\Season;
use App\Models\User;
use Illuminate\Console\Command;

class UserSeasonScoresRecalculate extends Command
{
    protected $signature = 'user-season-scores:recalculate {--season-id=}';
    protected $description = 'Recalculate user scores for all active seasons or a specified season.';

    public function handle(): void
    {
        $seasonId = $this->option('season-id');

        if (present($seasonId)) {
            $this->recalculate(Season::findOrFail(get_int($seasonId)));
        } else {
            $activeSeasons = Season::active()->get();

            foreach ($activeSeasons as $season) {
                $this->recalculate($season);
            }
        }
    }

    protected function recalculate(Season $season): void
    {
        $scoreUserIds = UserScoreAggregate::whereIn('room_id', $season->rooms->pluck('id'))
            ->distinct('user_id')
            ->pluck('user_id');

        $bar = $this->output->createProgressBar($scoreUserIds->count());

        User::whereIn('user_id', $scoreUserIds)
            ->chunkById(100, function ($userChunk) use ($bar, $season) {
                foreach ($userChunk as $user) {
                    $seasonScore = $user->seasonScores()
                        ->where('season_id', $season->getKey())
                        ->firstOrNew();

                    $seasonScore->season()->associate($season);
                    $seasonScore->calculate(false);
                    if ($seasonScore->total_score > 0) {
                        $seasonScore->save();
                    }

                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine();
    }
}
