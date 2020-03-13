<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
