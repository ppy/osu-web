<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Indexing;
use App\Models\ArtistTrack;
use App\Models\Beatmapset;
use App\Models\Forum\Post;
use App\Models\User;
use Illuminate\Console\Command;

class EsIndexDocuments extends Command
{
    const ALLOWED_TYPES = [
        'artist_tracks' => [ArtistTrack::class],
        'beatmapsets' => [Beatmapset::class],
        'posts' => [Post::class],
        'users' => [User::class],
    ];

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
    protected $inplace;
    protected $groups;
    protected $yes;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->readOptions();

        $oldIndices = [];
        foreach ($this->groups as $name) {
            $type = static::ALLOWED_TYPES[$name][0];
            $oldIndices[] = Indexing::getOldIndices($type::esIndexName());
        }

        $oldIndices = array_flatten($oldIndices);

        $continue = $this->starterMessage($oldIndices);
        if (!$continue) {
            return $this->error('User aborted!');
        }

        $start = time();

        foreach ($this->groups as $name) {
            $this->indexGroup($name);
        }

        $this->finish($oldIndices);
        $this->warn("\nIndexing completed in ".(time() - $start).'s');
    }

    protected function finish(array $oldIndices)
    {
        if (!$this->inplace && $this->cleanup) {
            foreach ($oldIndices as $index) {
                $this->warn("Removing '{$index}'...");
                Indexing::deleteIndex($index);
            }
        }
    }

    private function indexGroup($name)
    {
        $types = collect(static::ALLOWED_TYPES[$name]);

        $allSame = $types->every(function ($type) use ($types) {
            return $type::esIndexName() === $types->first()::esIndexName();
        });

        if (!$allSame) {
            $this->error("All types in group {$name} must have the same index.");

            return [];
        }

        $first = $types->first();
        $alias = $first::esIndexName();
        $indexName = $this->inplace ? $alias : $first::esTimestampedIndexName();
        $pretext = $this->inplace ? 'In-place indexing' : 'Indexing';

        foreach ($types as $type) {
            $bar = $this->output->createProgressBar();

            $this->info("{$pretext} {$type} into {$indexName}");

            if (!$this->inplace && $type === $first) {
                // create new index if the first type for this index, otherwise
                // index in place.
                $type::esIndexIntoNew(Es::CHUNK_SIZE, $indexName, function ($progress) use ($bar) {
                    $bar->setProgress($progress);
                });
            } else {
                $options = ['index' => $indexName];
                $type::esReindexAll(Es::CHUNK_SIZE, 0, $options, function ($progress) use ($bar) {
                    $bar->setProgress($progress);
                });
            }

            $bar->finish();
            $this->line("\n");
        }

        if ($alias !== $indexName) {
            $this->info("Aliasing {$alias} to {$indexName}");
            Indexing::updateAlias($alias, $indexName);
            $this->line('');
        }
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
}
