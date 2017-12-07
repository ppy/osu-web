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

use App\Libraries\Elasticsearch\Indexing;
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

    private $cleanup;
    private $hot;

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
        $this->readOptions();

        $indexName = 'osu';
        $oldIndices = Indexing::getOldIndices('osu');
        $types = [Beatmapset::class, Post::class];

        if ($this->hot) {
            $indexName .= '_'.time();
        }

        $continue = $this->starterMessage($indexName, $oldIndices);
        if (!$continue) {
            return $this->error('User aborted!');
        }

        $this->index($types, $indexName);
        $this->warn("\nIndexing of '{$indexName}' done.");

        $this->finish($indexName, $oldIndices);
    }

    private function finish(string $indexName, array $oldIndices)
    {
        if (!$this->hot) {
            return;
        }

        $this->warn("Aliasing '{$indexName}' to 'osu'...");

        // old index paths
        Indexing::updateAlias('osu', $indexName);

        if ($this->cleanup) {
            foreach ($oldIndices as $index) {
                $this->info("Removing '{$index}'...");
                Indexing::deleteIndex($index);
            }
        }
    }

    private function index(array $types, string $indexName)
    {
        // create new index if hot-reindexing, otherwise reuse the existing one.
        if ($this->hot) {
            Indexing::createMultiTypeIndex($indexName, $types);
        }

        foreach ($types as $type) {
            $this->info("Indexing {$type} into {$indexName}");
            $type::esReindexAll(1000, 0, ['index' => $indexName]);

            if ($this->hot) {
                // also alias for new index paths so we can shift them.
                $this->info("Aliasing '{$indexName}' to '{$type::esIndexName()}'...");
                Indexing::updateAlias($type::esIndexName(), $indexName);
            }
        }
    }

    private function readOptions()
    {
        $this->hot = $this->option('hot');
        $this->cleanup = $this->option('cleanup');
    }

    private function starterMessage(string $indexName, array $oldIndices)
    {
        if ($this->hot) {
            $this->warn("Running hot reindex on {$indexName}.");

            if ($this->cleanup) {
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

        return $this->confirm("{$confirmMessage}, begin indexing?");
    }
}
