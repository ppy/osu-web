<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Search\ScoreSearch;
use App\Models\Solo\Score;
use Ds\Set;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use LaravelRedis;
use Symfony\Component\Console\Helper\ProgressBar;

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

    private ProgressBar $bar;
    private ?string $schema;
    private int $total;

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

        $this->schema = presence($this->option('schema')) ?? presence(env('schema'));

        if ($this->schema === null) {
            return $this->error('Index schema must be specified');
        }

        $query = Score::select('id');
        $ids = new Set();
        $pushQuery = false;

        if ($this->option('all')) {
            $pushQuery = true;
        } else {
            $ids->add(...$this->parseOptionIds());

            $from = get_int($this->option('from'));
            if ($from !== null) {
                $query->orWhere('id', '>', $from);
                $pushQuery = true;
            }
        }

        if (!$pushQuery && $ids->count() === 0) {
            return $this->error('One of the id parameters must be specified');
        }

        $startTimeNs = hrtime(true);

        $this->bar = $this->output->createProgressBar();
        $this->bar->start();
        $this->total = 0;

        $this->queueIds($ids->toArray());

        if ($pushQuery) {
            $query->chunkById(100, function (Collection $scores): void {
                $this->queueIds(array_map(fn (Score $score): int => $score->getKey(), $scores->all()));
            });
        }

        (new ScoreSearch())->refresh();

        $this->bar->finish();
        $this->line('');
        $totalTime = (int) ((hrtime(true) - $startTimeNs) / 1000000000);
        $this->info("Queued {$this->total} scores in {$totalTime}s");
    }

    private function parseOptionIds(): Set
    {
        $ret = new Set();

        foreach (explode(',', get_string($this->option('ids')) ?? '') as $idString) {
            $id = get_int($idString);

            if ($id !== null) {
                $ret->add($id);
            }
        }

        return $ret;
    }

    private function queueIds(array $ids): void
    {
        $count = count($ids);

        if ($count === 0) {
            return;
        }

        LaravelRedis::lpush("osu-queue:score-index-{$this->schema}", ...array_map(
            fn (int $id): string => json_encode(['ScoreId' => $id]),
            $ids,
        ));

        $this->bar->advance($count);
        $this->total += $count;
    }
}
