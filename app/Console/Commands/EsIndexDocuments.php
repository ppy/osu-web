<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Indexing;
use App\Models\Beatmapset;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Illuminate\Console\Command;

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
    protected $inplace;
    protected $groups;
    protected $suffix;
    protected $yes;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        config()->set('indexing.batch', true);

        $this->readOptions();
        $this->suffix = !$this->inplace ? '_'.time() : '';

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
        $indices = [];
        $newIndices = [];
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
        $indexName = "{$first::esIndexName()}{$this->suffix}";
        $pretext = $this->inplace ? 'In-place indexing' : 'Indexing';

        foreach ($types as $type) {
            $count = $type::esIndexingQuery()->count();
            $bar = $this->output->createProgressBar($count);

            $this->info("{$pretext} {$type} into {$indexName}");

            if (!$this->inplace && $type === $first) {
                // create new index if the first type for this index, otherwise
                // index in place.
                $type::esIndexIntoNew(static::BATCH_SIZE, $indexName, function ($progress) use ($bar) {
                    $bar->setProgress($progress);
                });
            } else {
                $options = ['index' => $indexName];
                $type::esReindexAll(static::BATCH_SIZE, 0, $options, function ($progress) use ($bar) {
                    $bar->setProgress($progress);
                });
            }

            $bar->finish();
            $this->line("\n");
        }

        if ($name === 'users') {
            $this->afterIndexUsers($indexName);
        }

        if ($alias !== $indexName) {
            $this->info("Aliasing {$alias} to {$indexName}");
            Indexing::updateAlias($alias, [$indexName]);
            $this->line('');
        }
    }

    // TODO: should go somewhere else
    protected function afterIndexUsers($indexName)
    {
        $this->line("Do additional indexing for {$indexName}");

        $batchSize = 1000;
        $baseQuery = UsernameChangeHistory::visible();
        $total = $baseQuery->count();
        $bar = $this->output->createProgressBar($total);
        $count = 0;
        $client = Es::getClient();

        $baseQuery->select(['change_id', 'user_id', 'username_last'])->chunkById($batchSize, function ($models) use ($bar, &$count, $client, $indexName) {
            $actions = [];

            foreach ($models as $model) {
                $count++;
                if (!present($model->username_last)) {
                    continue;
                }

                $metadata = ['_id' => $model->user_id];
                $actions[] = ['update' => $metadata];
                $actions[] = [
                    'script' => [
                        'lang' => 'painless',
                        'source' => 'if (ctx._source.previous_usernames == null) {
                            ctx._source.previous_usernames = [params.previous_usernames]
                        } else if (!ctx._source.previous_usernames.contains(params.previous_usernames)) {
                            ctx._source.previous_usernames.add(params.previous_usernames)
                        }',
                        'params' => [
                            'previous_usernames' => $model->username_last,
                        ],
                    ],
                ];
            }

            if ($actions !== []) {
                $client->bulk([
                    'index' => $indexName,
                    'type' => 'users',
                    'body' => $actions,
                    'client' => ['timeout' => 0],
                ]);
            }

            $bar->setProgress($count);
        });

        $bar->finish();
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
