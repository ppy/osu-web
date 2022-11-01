<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Exceptions\InvariantException;
use App\Libraries\Search\ScoreSearch;
use App\Models\Solo\Score;
use Ds\Set;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class EsIndexScoresQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-scores:queue
        {--a|all : Queue all the scores in the database}
        {--from= : Queue all the scores after (but not including) the specified id}
        {--ids= : Queue specified comma-separated list of score ids}
        {--schema= : Index schema to queue the scores to. Will use active schemas set in redis if not specified}
        {--user= : Filter scores by user id}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue scores to be indexed into Elasticsearch.';

    private ProgressBar $bar;
    private array $ids;
    private array $schemas;
    private ScoreSearch $search;
    private int $total;
    private Builder $query;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->search = new ScoreSearch();

        $this->parseOptions();

        if (!$this->confirm('This will queue scores for indexing to schema '.implode(', ', $this->schemas).', continue?', true)) {
            return $this->info('User aborted');
        }

        $startTimeNs = hrtime(true);

        $this->bar = $this->output->createProgressBar();
        $this->bar->start();
        $this->total = 0;

        if (isset($this->ids)) {
            $this->queueIds($this->ids);
        }

        if (isset($this->query)) {
            $this->query->chunkById(100, function (Collection $scores): void {
                $this->queueIds(array_map(fn (Score $score): int => $score->getKey(), $scores->all()));
            });
        }

        $this->search->refresh();

        $this->bar->finish();
        $this->line('');
        $totalTime = (int) ((hrtime(true) - $startTimeNs) / 1000000000);
        $this->info("Queued {$this->total} scores in {$totalTime}s");
    }

    private function parseOptions(): void
    {
        $query = Score::select('id');
        $userId = get_int($this->option('user'));
        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        $doneParsingId = false;

        $ids = $this->parseOptionIds();
        if ($ids->count() > 0) {
            $doneParsingId = true;
            if ($userId === null) {
                $this->ids = $ids->toArray();
            } else {
                $this->query = $query->whereKey($ids->toArray());
            }
        }

        $from = get_int($this->option('from'));
        if ($from !== null) {
            if ($doneParsingId) {
                throw new InvariantException('only one of the id parameters may be specified');
            }
            $doneParsingId = true;
            $this->query = $query->where('id', '>', $from);
        }

        if ($this->option('all')) {
            if ($doneParsingId) {
                throw new InvariantException('only one of the id parameters may be specified');
            }
            $doneParsingId = true;
            $this->query = $query;
        }

        if (!$doneParsingId) {
            throw new InvariantException('id parameter must be specified');
        }

        $schema = presence($this->option('schema'));
        if ($schema === null) {
            $this->schemas = $this->search->getActiveSchemas();

            if (count($this->schemas) === 0) {
                throw new InvariantException('Index schema is not specified and there is no active schemas');
            }
        } else {
            $this->schemas = [$schema];
        }
    }

    private function parseOptionIds(): Set
    {
        $ret = new Set();
        $ids = $this->option('ids');
        $ids = is_array($ids) ? $ids : explode(',', get_string($ids) ?? '');

        foreach ($ids as $idString) {
            $id = get_int($idString);

            if ($id !== null) {
                $ret->add($id);
            }
        }

        return $ret;
    }

    private function queueIds(array $ids): void
    {
        $this->search->queueForIndex($this->schemas, $ids);

        $this->bar->setProgress(array_last($ids) ?? 0);
        $this->total += count($ids);
    }
}
