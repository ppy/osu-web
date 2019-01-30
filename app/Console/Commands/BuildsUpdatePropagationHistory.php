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

use App\Models\Build;
use App\Models\BuildPropagationHistory;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class BuildsUpdatePropagationHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'builds:update-propagation-history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the build propagation history based on current data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::transaction(function () {
            $date = Carbon::now();

            $builds = Build::propagationHistory()
                ->whereIn('stream_id', config('osu.changelog.update_streams'))
                ->get();

            foreach ($builds as $build) {
                BuildPropagationHistory::create([
                    'build_id' => $build->build_id,
                    'user_count' => $build->users,
                    'created_at' => $date,
                ]);
            }
        }, 3);
    }
}
