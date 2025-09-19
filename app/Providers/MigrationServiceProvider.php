<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Console\Commands\MigrateFreshAllCommand;
use Illuminate\Database\Console\Migrations\FreshCommand;
use Illuminate\Database\MigrationServiceProvider as BaseProvider;

class MigrationServiceProvider extends BaseProvider
{
    #[\Override]
    public function registerMigrateFreshCommand()
    {
        foreach ([FreshCommand::class, MigrateFreshAllCommand::class] as $class) {
            $this->app->singleton(
                $class,
                fn ($app) => new MigrateFreshAllCommand($app['migrator']),
            );
        }
    }
}
