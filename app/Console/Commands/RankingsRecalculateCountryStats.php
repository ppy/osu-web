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

use App\Models\Beatmap;
use App\Models\Country;
use App\Models\CountryStatistics;
use Illuminate\Console\Command;

class RankingsRecalculateCountryStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rankings:recalculate-country-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculates country stats from the lastest data.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $countries = Country::where('rankedscore', '>', 0)->get();
        $bar = $this->output->createProgressBar(count($countries) * count(Beatmap::MODES));

        foreach ($countries as $country) {
            foreach (Beatmap::MODES as $mode) {
                CountryStatistics::recalculate($country->acronym, $mode);
                $bar->advance();
            }
        }

        $bar->finish();
    }
}
