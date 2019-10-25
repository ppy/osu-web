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
