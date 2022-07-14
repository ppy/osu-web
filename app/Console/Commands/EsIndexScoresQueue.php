<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Search\ScoreSearch;
use App\Models\Solo\Score;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use LaravelRedis;

class EsIndexScoresQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-scores:queue
        {--ids= : Queue specified comma-separated list of score ids}
        {--from= : Queue all the scores after (but not including) the specified id}
        {--a|all : Queue all the scores in the database}
        {--schema= : Index schema to queue the scores to (can also be specified using environment variable "schema")}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue scores to be indexed into Elasticsearch.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('This will queue scores for indexing, continue?', true)) {
            return $this->info('User aborted');
        }

        $schema = presence($this->option('schema')) ?? presence(env('schema'));

        if ($schema === null) {
            return $this->error('Index schema must be specified');
        }

        $query = Score::select('id');

        $validIds = false;
        if ($this->option('all')) {
            $validIds = true;
        } else {
            $ids = array_filter(array_map('get_int', explode(',', get_string($this->option('ids')) ?? '')), 'present');
            if (count($ids) > 0) {
                $query->orWhereIn('id', $ids);
                $validIds = true;
            }

            $from = get_int($this->option('from'));
            if ($from !== null) {
                $query->orWhere('id', '>', $from);
                $validIds = true;
            }
        }

        if (!$validIds) {
            return $this->error('One of the id parameters must be specified');
        }

        $startTimeNs = hrtime(true);
        $total = 0;

        $bar = $this->output->createProgressBar();
        $bar->start();

        $queue = "osu-queue:score-index-{$schema}";
        $query->chunkById(100, function (Collection $scores) use ($bar, $queue, $total): void {
            LaravelRedis::lpush($queue, ...array_map(
                fn (Score $score): string => json_encode(['ScoreId' => $score->getKey()]),
                $scores->all(),
            ));
            $count = $scores->count();
            $bar->advance($count);
            $total += $count;
        });

        (new ScoreSearch())->refresh();

        $bar->finish();
        $this->line('');
        $totalTime = (int) ((hrtime(true) - $startTimeNs) / 1000000000);
        $this->info("Indexing completed in {$totalTime}s");
    }
}
