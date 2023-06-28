<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Search\ScoreSearch;
use Illuminate\Database\Console\Migrations\FreshCommand;
use Symfony\Component\Console\Input\InputOption;

class MigrateFreshAllCommand extends FreshCommand
{
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return 1;
        }

        $connections = config('database.connections');

        $this->warn('This will drop tables in the following databases:');

        foreach ($connections as $name => $config) {
            $this->warn("{$name} => {$config['database']}");
        }

        $continue = $this->option('yes') || $this->confirm('continue?');
        if (!$continue) {
            $this->error('User aborted!');
            return 1;
        }

        foreach (array_keys($connections) as $database) {
            $this->warn($database);
            $this->call('db:wipe', [
                '--database' => $database,
            ]);
        }

        $this->info('Dropped all tables successfully.');

        $this->call('migrate', [
            '--path' => $this->input->getOption('path'),
        ]);

        $this->info('Setup elasticsearch indices.');

        $this->call('es:index-documents', [
            '--cleanup' => true,
            '--yes' => $this->option('yes'),
        ]);

        $this->call('es:index-wiki', [
            '--cleanup' => true,
            '--create-only' => true,
            '--yes' => $this->option('yes'),
        ]);

        $this->call('es:create-search-blacklist');

        $schema = presence(env('SCHEMA'));

        if ($schema !== null) {
            $this->waitForActiveSchemaAndSet($schema);
        } else {
            $this->info('No score index schema set, skipping.');
        }

        if ($this->needsSeeding()) {
            $this->runSeeder(null);
        }

        return 0;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'This option is ignored.'],
            ['path', null, InputOption::VALUE_OPTIONAL, 'The path of migrations files to be executed.'],
            ['seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'],
            ['seeder', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder.'],
            ['yes', null, InputOption::VALUE_NONE, 'Skip the confirmation prompt.'],
        ];
    }

    // Wait for score indexer to start and set active schema
    private function waitForActiveSchemaAndSet(string $schema, float $maxWaitSeconds = 10): void
    {
        $loopWait = 500000; // 0.5s in microsecond
        $loops = (int) ceil($maxWaitSeconds * 1000000.0 / $loopWait);
        $this->warn("waiting for score indexer schema \"{$schema}\"");

        for ($i = 0; $i < $loops; $i++) {
            usleep($loopWait);
            $activeSchemas = (new ScoreSearch())->getActiveSchemas();
            if (in_array($schema, $activeSchemas, true)) {
                $this->call('es:index-scores:set-schema', [
                    '--schema' => $schema,
                ]);

                return;
            }
        }

        $this->error("Could not find active schema \"{$schema}\" after {$maxWaitSeconds} seconds, not setting schema.");
    }
}
