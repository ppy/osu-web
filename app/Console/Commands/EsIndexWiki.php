<?php

namespace App\Console\Commands;

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
    protected $signature = 'es:index-wiki';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-indexes wiki pages';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
            $search = static::newBaseSearch()->searchAfter(array_values($cursor));
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
            $page->sync(true);

            if (!$page->isVisible()) {
                $this->warn("delete {$pagePath['locale']}: {$pagePath['path']}");
                $page->esDeleteDocument();
            }

            $bar->advance();
        }

        $bar->finish();
    }

    private static function newBaseSearch(): Search
    {
        return (new BasicSearch(config('osu.elasticsearch.index.wiki_pages')))
            ->query(['match_all' => new \stdClass])
            ->sort(new Sort('_id', 'asc'))
            ->source(false);
    }
}
