<?php

namespace App\Console\Commands;

use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Sort;
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
    protected $description = 'Re-indexes the wiki pages that are currently indexed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cursor = ['']; // works with Sort(_id, asc) to start at the beginning.
        // estimate count; will be incorrect if docs are added or removed while in progress.
        $bar = $this->output->createProgressBar(static::newBaseSearch()->count());

        while ($cursor !== null) {
            $search = static::newBaseSearch()->searchAfter(array_values($cursor));
            $response = $search->response();

            foreach ($response as $hit) {
                $page = Page::fromEs($hit);
                $page->sync(true);
                if (!$page->isVisible()) {
                    $page->esDeleteDocument();
                }

                $bar->advance();
            }

            $cursor = $search->getSortCursor();
        }

        $bar->finish();
    }

    private static function newBaseSearch() : Search
    {
        return (new BasicSearch(config('osu.elasticsearch.index.wiki_pages')))
            ->query(['match_all' => new \stdClass])
            ->sort(new Sort('_id', 'asc'));
    }
}
