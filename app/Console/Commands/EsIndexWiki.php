<?php

namespace App\Console\Commands;

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Indexing;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\OsuWiki;
use App\Libraries\Search\BasicSearch;
use App\Models\Wiki\Page;
use Illuminate\Console\Command;

class EsIndexWiki extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-wiki {--inplace} {--cleanup} {--yes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-indexes wiki pages';

    private $cleanup;
    private $indexName;
    private $inplace;
    private $yes;

    public function handle()
    {
        $this->readOptions();

        $alias = Page::esIndexName();
        $oldIndices = Indexing::getOldIndices($alias);
        $continue = $this->starterMessage($oldIndices);
        if (!$continue) {
            return $this->error('User aborted!');
        }

        if (!$this->inplace || empty($oldIndices)) {
            $this->indexName = Page::esTimestampedIndexName();
        } else {
            $this->indexName = $oldIndices[0];
        }

        if (!Es::getClient()->indices()->exists(['index' => [$this->indexName]])) {
            $this->info("Creating '{$this->indexName}'...");
            Page::esCreateIndex($this->indexName);
        }

        $this->reindex();

        Indexing::updateAlias($alias, [$this->indexName]);

        $this->finish($oldIndices);
    }

    private function finish(array $oldIndices)
    {
        if (!$this->inplace && $this->cleanup) {
            foreach ($oldIndices as $index) {
                $this->warn("Removing '{$index}'...");
                Indexing::deleteIndex($index);
            }
        }
    }

    private function newBaseSearch(): Search
    {
        return (new BasicSearch($this->indexName))
            ->query(['match_all' => new \stdClass])
            ->sort(new Sort('_id', 'asc'))
            ->source(false);
    }


    private function readOptions()
    {
        $this->inplace = $this->option('inplace');
        $this->cleanup = $this->option('cleanup');
        $this->yes = $this->option('yes');
    }

    private function reindex()
    {
        // for storing the paths as keys; the values don't matter in practise.
        $paths = [];

        $this->line('Fetching page list from Github...');
        OsuWiki::getPageList()->each(function ($path) use (&$paths) {
            $path = str_replace_first('wiki/', '', $path);
            $paths[$path] = false;
        });

        $this->line(count($paths).' pages found');

        $this->line('Fetching existing list...');
        $cursor = ['']; // works with Sort(_id, asc) to start at the beginning.
        while ($cursor !== null) {
            $search = $this->newBaseSearch()->searchAfter(array_values($cursor));
            $response = $search->response();

            foreach ($response as $hit) {
                $paths[$hit['_id']] = true;
            }

            $cursor = $search->getSortCursor();
        }

        $total = count($paths);
        $this->line("Total: {$total} documents");
        $bar = $this->output->createProgressBar($total);

        foreach ($paths as $path => $_inEs) {
            $pagePath = Page::parsePagePath($path);
            $page = new Page($pagePath['path'], $pagePath['locale']);
            $page->sync(true, $this->indexName);

            if (!$page->isVisible()) {
                $this->warn("delete {$pagePath['locale']}: {$pagePath['path']}");
                $page->esDeleteDocument(['index' => $this->indexName]);
            }

            $bar->advance();
        }

        $bar->finish();
    }

    private function starterMessage(array $oldIndices)
    {
        if ($this->inplace) {
            $this->warn('Running in-place reindex.');
            $confirmMessage = 'This will reindex in-place (schemas must match)';
        } else {
            $this->warn('Running index transfer.');

            if ($this->cleanup) {
                $this->warn(
                    "The following indices will be deleted on completion!\n"
                    .implode("\n", $oldIndices)
                );
            }

            $confirmMessage = 'This will create new indices';
        }

        return $this->yes || $this->confirm("{$confirmMessage}, begin indexing?");
    }
}
