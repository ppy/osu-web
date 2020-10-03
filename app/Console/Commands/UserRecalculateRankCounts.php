<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Beatmap;
use App\Models\Score\Best;
use App\Models\UserStatistics;
use Exception;
use Illuminate\Console\Command;

class UserRecalculateRankCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:recalculate-rank-counts {--from=} {--until=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate rank counts for user statistics.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->from = $this->option('from');
        $this->until = $this->option('until');

        $continue = $this->confirm('This will recalculate and update the rank counts for user statistics, continue?');

        if (!$continue) {
            return $this->error('User aborted!');
        }

        $start = time();

        foreach (Beatmap::MODES as $mode => $id) {
            $this->processMode($mode);
        }

        $this->warn("\n".(time() - $start).'s taken.');
    }

    private function processMode($mode)
    {
        $this->info("Recalculating {$mode}");
        $class = UserStatistics::class.'\\'.studly_case($mode);
        $query = $class::query();
        if (present($this->from)) {
            $query->where('user_id', '>=', $this->from);
        }

        if (present($this->until)) {
            $query->where('user_id', '<=', $this->until);
        }

        $count = $query->count();
        $bar = $this->output->createProgressBar($count);

        $query->chunkById(1000, function ($chunk) use ($bar) {
            foreach ($chunk as $stats) {
                try {
                    $counts = $this->getCountsWithStats($stats);
                    $stats->update([
                        'x_rank_count' => $counts['X'],
                        'xh_rank_count' => $counts['XH'],
                        's_rank_count' => $counts['S'],
                        'sh_rank_count' => $counts['SH'],
                        'a_rank_count' => $counts['A'],
                    ]);

                    $bar->advance();
                } catch (Exception $e) {
                    $this->error("Exception caught, user_id: {$stats->user_id}");
                    $this->error($e->getMessage());
                }
            }
        }, 'user_id');

        $bar->finish();
        $this->info('');
    }

    private function getCountsWithStats($stats)
    {
        $class = Best::class.'\\'.get_class_basename(get_class($stats));
        $counts = $class::where('user_id', '=', $stats->user_id)
            ->accurateRankCounts()[$stats->user_id] ?? [];

        return $this->map($counts);
    }

    private function map($values)
    {
        return [
            'XH' => $values['XH'] ?? 0,
            'SH' => $values['SH'] ?? 0,
            'X' => $values['X'] ?? 0,
            'S' => $values['S'] ?? 0,
            'A' => $values['A'] ?? 0,
        ];
    }
}
