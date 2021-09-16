<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Elasticsearch\Es;
use Illuminate\Console\Command;

class EsCreateSearchBlacklist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:create-search-blacklist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the search blacklist index if it does not exist.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alias = config('osu.elasticsearch.prefix').'blacklist';
        $client = Es::getClient();

        /** @var array $response The type-hint in the doc is wrong. */
        $response = $client->indices()->get(['index' => $alias, 'client' => ['ignore' => 404]]);

        $statusCode = $response['status'] ?? null;
        if ($statusCode === null) {
            $this->info("{$alias} already exists, skipping.");

            return;
        }

        $index = $alias.'_'.time();
        $this->info("{$alias} does exist, creating aliased index {$index}...");
        $client->indices()->create([
            'body' => [
                'aliases' => [$alias => new \stdClass()],
                'settings' => ['number_of_shards' => 1],
            ],
            'index' => $index,
        ]);
    }
}
