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
            return $this->error('Missing stream-id');
        }

        $stream = UpdateStream::findOrFail($streamId);

        $build = $stream->createBuild();

        if ($build === null) {
            return $this->info('No build created (probably no orphan changelog entry).');
        }

        $this->info("Created build {$build->displayVersion()}");
        $this->info('URL: '.build_url($build));
    }
}
