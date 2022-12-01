<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbSetup extends Command
{
    protected $signature = 'db:setup {--force}';

    protected $description = 'Create empty databases and run migrations. This does not initialise elasticsearch indexes';

    public function handle()
    {
        $this->call('db:create');
        $this->call('migrate', [
            '--force' => $this->option('force'),
        ]);
    }
}
