<?php

namespace App\Console\Commands;

use App\Libraries\Elasticsearch\ModelIndexing;
use App\Models\Beatmapset;
use App\Models\Forum\Post;
use Illuminate\Console\Command;

class EsIndexDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-documents {--hot} {--cleanup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes documents into Elasticsearch.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hot = $this->option('hot');
        $cleanup = $this->option('cleanup');

        $oldIndices = ModelIndexing::getOldIndices('osu');
        $indexName = 'osu';

        if ($hot) {
            $indexName .= '_'.time();
            $this->warn("Running hot reindex on {$indexName}.");

            if ($cleanup) {
                $this->warn(
                    "The following indices will be deleted on completion!\n"
                    .implode("\n", $oldIndices)
                );
            }

            $confirmMessage = "This will create the index '{$indexName}' and alias it to 'osu'";
        } else {
            $this->warn("Running cold reindex on {$indexName}.");
            $confirmMessage = "This reindex '{$indexName}' in-place (schemas must match)";
        }

        $continue = $this->confirm("{$confirmMessage}, begin indexing?");

        if (!$continue) {
            return $this->error('User aborted!');
        }

        $types = [Beatmapset::class, Post::class];

        // create new index if hot-reindexing, otherwise reuse the existing one.
        if ($hot) {
            ModelIndexing::createMultiTypeIndex($indexName, $types);
        }

        foreach ($types as $type) {
            $this->info("Indexing {$type} into {$indexName}");
            $type::esReindexAll(1000, 0, ['index' => $indexName]);

            if ($hot) {
                // also alias for new index paths so we can shift them.
                $this->info("Aliasing '{$indexName}' to '{$type::esIndexName()}'...");
                ModelIndexing::updateAlias($type::esIndexName(), $indexName);
            }
        }

        $this->warn("\nIndexing of '{$indexName}' done.");

        if ($hot) {
            $this->warn("Aliasing '{$indexName}' to 'osu'...");

            // old index paths
            ModelIndexing::updateAlias('osu', $indexName);

            if ($cleanup) {
                foreach ($oldIndices as $index) {
                    $this->info("Removing '{$index}'...");
                    ModelIndexing::deleteIndex($index);
                }
            }
        }
    }
}
