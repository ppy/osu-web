<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class DbCreate extends Command
{
    protected $signature = 'db:create';

    protected $description = 'Create empty databases';

    public function handle()
    {
        $defaultConnection = config('database.connections.mysql');

        $dsn = isset($defaultConnection['unix_socket'])
            ? "mysql:unix_socket={$defaultConnection['unix_socket']}"
            : "mysql:host={$defaultConnection['host']};port={$defaultConnection['port']}";

        $pdo = new PDO($dsn, $defaultConnection['username'], $defaultConnection['password']);

        foreach (config('database.connections') as $connection) {
            $db = $connection['database'];

            $this->info("Creating database '{$db}'");
            $pdo->exec("CREATE DATABASE IF NOT EXISTS {$db} DEFAULT CHARSET utf8mb4");
        }
    }
}
