<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use Illuminate\Database\Console\Migrations\FreshCommand;
use Symfony\Component\Console\Input\InputOption;

class MigrateFreshAllCommand extends FreshCommand
{
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $connections = config('database.connections');

        $this->warn('This will drop tables in the following databases:');

        foreach ($connections as $name => $config) {
            $this->warn("{$name} => {$config['database']}");
        }

        $continue = $this->option('yes') || $this->confirm('continue?');
        if (!$continue) {
            return $this->error('User aborted!');
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

        if ($this->needsSeeding()) {
            $this->runSeeder(null);
        }
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
}
