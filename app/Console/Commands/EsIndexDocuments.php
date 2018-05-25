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
use App\Models\Forum\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;

class EsIndexDocuments extends Command
{
    const ALLOWED_TYPES = [
        'beatmapsets' => [Beatmapset::class],
        'posts' => [Topic::class, Post::class],
        'users' => [User::class],
    ];

    const BATCH_SIZE = 1000;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-documents {--types=} {--inplace} {--cleanup} {--yes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes documents into Elasticsearch.';

    protected $cleanup;
    protected $existingAliases;
    protected $inplace;
    protected $groups;
    protected $skipCounts = false;
    protected $suffix;
    protected $yes;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->readOptions();
        $this->loadMetadata();
        $this->suffix = !$this->inplace ? '_'.time() : '';

        $oldIndices = array_flatten(array_values($this->existingAliases));

        $continue = $this->starterMessage($oldIndices);
        if (!$continue) {
            return $this->error('User aborted!');
        }

        $start = time();

        $indices = $this->index();

        $this->finish($indices, $oldIndices);
        $this->warn("\nIndexing completed in ".(time() - $start).'s');
    }

    public function getLastUpdatedId(string $index)
    {
        return 0;
    }

    public function setLastUpdated(string $index, Carbon $updatedAt, $id)
    {
        Log::info("{$index} next: {$id}");
    }

    protected function finish(array $indices, array $oldIndices)
    {
        if (!$this->inplace && $this->cleanup) {
            foreach ($oldIndices as $index) {
                $this->warn("Removing '{$index}'...");
                Indexing::deleteIndex($index);
            }
        }
    }

    /**
     * Indexes and returns the names of the indices.
     *
     * @return array names of the indices indexed to.
     */
    protected function index()
    {
        $indices = [];
        foreach ($this->groups as $name) {
            $indices = array_merge($indices, $this->indexGroup($name));
        }

        return $indices;
    }

    private function indexGroup($name)
    {
        $indices = [];
        $types = static::ALLOWED_TYPES[$name];

        foreach ($types as $i => $type) {
            $indexName = "{$type::esIndexName()}{$this->suffix}";
            $lastUpdatedId = $this->inplace ? $this->getLastUpdatedId($indexName) : 0;
            $count = $this->skipCounts ? null : $type::esIndexingQueryFrom($lastUpdatedId)->count();
            $bar = $this->output->createProgressBar($count);

            $pretext = $this->inplace ? 'In-place indexing' : 'Indexing';
            $this->info("{$pretext} {$type} into {$indexName}");

            if (!$this->inplace && $i === 0) {
                // create new index if the first type for this index, otherwise
                // index in place.
                $type::esIndexIntoNew(static::BATCH_SIZE, $indexName, function ($progress, $lastId) use ($bar, $indexName) {
                    $bar->setProgress($progress);
                    $this->setLastUpdated($indexName, Carbon::now(), $lastId);
                });
            } else {
                $type::esReindexAll(static::BATCH_SIZE, $lastUpdatedId, [], function ($progress, $lastId) use ($bar, $indexName) {
                    $bar->setProgress($progress);
                    $this->setLastUpdated($indexName, Carbon::now(), $lastId);
                });
            }

            if ($i === 0) {
                $indices[] = $type::esIndexName();
            }

            $bar->finish();
            $this->line("\n");
        }

        return $indices;
    }

    protected function getRealIndexName(string $index)
    {
        // this needs to be updated if we have more than 1 index per alias.
        return $this->existingAliases[$index][0] ?? $index;
    }

    protected function readOptions()
    {
        $this->inplace = $this->option('inplace');
        $this->cleanup = $this->option('cleanup');
        $this->yes = $this->option('yes');

        if ($this->option('types')) {
            $types = explode(',', $this->option('types'));
            $this->groups = [];
            foreach ($types as $type) {
                if (array_key_exists($type, static::ALLOWED_TYPES)) {
                    $this->groups[] = $type;
                }
            }
        } else {
            $this->groups = array_keys(static::ALLOWED_TYPES);
        }
    }

    protected function starterMessage(array $oldIndices)
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

    private function loadMetadata()
    {
        foreach ($this->groups as $name) {
            $type = static::ALLOWED_TYPES[$name][0];
            $this->existingAliases[$type::esIndexName()] = Indexing::getOldIndices($type::esIndexName());
        }
    }
}
