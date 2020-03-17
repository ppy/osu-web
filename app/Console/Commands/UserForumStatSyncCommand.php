<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserForumStatSyncCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'user:forumsync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronises forum post counts for all users.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $progress;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Synchronising user post counts...');

        $this->progress = $this->output->createProgressBar(User::count());

        User::chunkById(1000, function ($users) {
            foreach ($users as $u) {
                $u->refreshForumCache();
                $this->progress->advance();
            }
        });

        $this->progress->finish();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
