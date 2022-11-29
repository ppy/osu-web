<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateFreshOrRunCommand extends Command
{
    protected $signature = 'migrate:fresh-or-run';

    protected $description = 'Run a migrate:fresh on empty database or just run plain migrate otherwise';

    protected $migrator;

    public function __construct()
    {
        $this->migrator = app('migration.repository');

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->migrator->repositoryExists() || $this->migrator->getLastBatchNumber() === null) {
            $this->fresh();
        } else {
            $this->migrate();
        }
    }

    private function fresh()
    {
        $this->info('Database is empty. Calling migrate:fresh to initalise database and elasticsearch.');
        $this->call('migrate:fresh', ['--yes' => true]);
    }

    private function migrate()
    {
        $this->info('Running pending migrations...');
        $this->call('migrate', ['--step' => true]);
    }
}
