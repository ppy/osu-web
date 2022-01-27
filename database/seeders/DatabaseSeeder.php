<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Miscellaneous Data (e.g. counts)
            $this->call(ModelSeeders\MiscSeeder::class);

            // Countries
            $this->call(ModelSeeders\CountrySeeder::class);

            // Users, Stats, Ranks
            $this->call(ModelSeeders\UserSeeder::class);

            // Beatmaps and sets
            $this->call(ModelSeeders\BeatmapSeeder::class);

            // Events
            $this->call(ModelSeeders\EventSeeder::class);

            // Scores
            $this->call(ModelSeeders\ScoreSeeder::class);

            // BanchoStats
            $this->call(ModelSeeders\BanchoStatsSeeder::class);

            // Forums, topics, posts etc
            $this->call(ModelSeeders\ForumSeeder::class);

            // Users Profile Data (Favourite maps, First place ranks, Playcounts)
            $this->call(ModelSeeders\UserProfileSeeder::class);

            // Store Products
            $this->call(ModelSeeders\ProductSeeder::class);

            // Changelog data (base update streams, builds, changes, build histories)
            $this->call(ModelSeeders\ChangelogSeeder::class);
        } catch (Exception $ex) {
            $this->command->error($ex->getMessage());
        }
    }
}
