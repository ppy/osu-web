<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class DbCreate extends Command
{
    protected $signature = 'db:create';

    protected $description = 'Create empty databases';

    public function handle()
    {
        foreach (config('database.connections') as $connection) {
            $db = $connection['database'];

            $this->info("Creating database '{$db}'");
            DB::unprepared("CREATE DATABASE IF NOT EXISTS {$db} DEFAULT CHARSET utf8mb4");
        }
    }
}
