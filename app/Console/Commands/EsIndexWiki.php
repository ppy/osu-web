<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Indexing;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\OsuWiki;
use App\Libraries\Search\BasicSearch;
use App\Libraries\Wiki\WikiSitemap;
use App\Models\Wiki\Page;
use Illuminate\Console\Command;

class EsIndexWiki extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-wiki {--create-only} {--inplace} {--cleanup} {--yes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-indexes wiki pages';

    private $cleanup;
    private $createOnly;
    private $indexName;
    private $indicesToRemove;
    private $inplace;
    private $yes;

    public function handle()
    {
        $this->readOptions();

        $alias = Page::esIndexName();
        $oldIndices = Indexing::getOldIndices($alias);

        if (!$this->inplace || empty($oldIndices)) {
            $this->indexName = Page::esTimestampedIndexName();
        } else {
            $this->indexName = $oldIndices[0];
        }

        $this->indicesToRemove = array_filter($oldIndices, function ($index) {
            // because removing the index we just wrote to would be silly.
            return $this->indexName !== $index;
        });

        $continue = $this->starterMessage();
        if (!$continue) {
            return $this->error('User aborted!');
        }

        if (!Es::getClient()->indices()->exists(['index' => [$this->indexName]])) {
            $this->info("Creating '{$this->indexName}'...");
            Page::esCreateIndex($this->indexName);
        }

        $this->reindex();

        Indexing::updateAlias($alias, $this->indexName);

        $this->updateSitemap();

        $this->finish();
    }

    private function finish()
    {
        if (!$this->cleanup) {
            return;
        }

        foreach ($this->indicesToRemove as $index) {
            $this->warn("Removing '{$index}'...");
            Indexing::deleteIndex($index);
        }
    }

    private function newBaseSearch(): Search
    {
        return (new BasicSearch($this->indexName))
            ->query(['match_all' => new \stdClass()])
            ->sort([new Sort('path.keyword', 'asc'), new Sort('locale.keyword', 'asc')])
            ->source(false);
    }

    private function readOptions()
    {
        $this->createOnly = $this->option('create-only');
        $this->inplace = $this->option('inplace');
        $this->cleanup = $this->option('cleanup');
        $this->yes = $this->option('yes');
    }

    private function reindex()
    {
        if ($this->createOnly) {
            return;
        }
        // for storing the paths as keys; the values don't matter in practise.
        $paths = [];

        $this->line('Fetching page list from Github...');
        OsuWiki::getPageList()->each(function ($path) use (&$paths) {
            $path = str_replace_first('wiki/', '', $path);
            $paths[$path] = false;
        });

        $this->line(count($paths).' pages found');

        if ($this->inplace) {
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
        $this->line('');
    }

    private function starterMessage()
    {
        if ($this->cleanup) {
            $this->warn(
                "The following indices will be deleted on completion!\n"
                .implode("\n", $this->indicesToRemove)
            );
        }

        return $this->yes || $this->confirm("This index to {$this->indexName}, begin indexing?");
    }

    private function updateSitemap()
    {
        $this->line('Updating wiki sitemap...');
        WikiSitemap::expire();
        WikiSitemap::get();
    }
}
