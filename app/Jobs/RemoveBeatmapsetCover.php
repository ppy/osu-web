<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Jobs;

use App\Models\Beatmapset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemoveBeatmapsetCover implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $beatmapset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset)
    {
        $this->beatmapset = $beatmapset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->beatmapset->removeCovers();
    }
}
