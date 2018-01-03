<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
            ->accurateRankCounts()
            [$stats->user_id] ?? [];

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
