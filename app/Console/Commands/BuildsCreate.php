<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\UpdateStream;
use Illuminate\Console\Command;

class BuildsCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'builds:create {--stream-id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates build from orphan changelog entries of specified stream id';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $streamId = get_int($this->option('stream-id'));

        if ($streamId === null) {
            $this->error('Missing stream-id');
            return;
        }

        $stream = UpdateStream::findOrFail($streamId);

        $build = $stream->createBuild();

        if ($build === null) {
            $this->info('No build created (probably no orphan changelog entry).');
            return;
        }

        $this->info("Created build {$build->displayVersion()}");
        $this->info('URL: '.build_url($build));
    }
}
