<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            $this->call(MiscSeeder::class);

            // Countries
            $this->call(CountrySeeder::class);

            // Users, Stats, Ranks
            $this->call(UserSeeder::class);

            // Beatmaps and sets
            $this->call(BeatmapSeeder::class);

            // Events
            $this->call(EventSeeder::class);

            // Scores
            $this->call(ScoreSeeder::class);

            // BanchoStats
            $this->call(BanchoStatsSeeder::class);

            // Forums, topics, posts etc
            $this->call(ForumSeeder::class);

            // Users Profile Data (Favourite maps, First place ranks, Playcounts)
            $this->call(UserProfileSeeder::class);

            // Store Products
            $this->call(ProductSeeder::class);

            // Changelog data (base update streams, builds, changes, build histories)
            $this->call(ChangelogSeeder::class);
        } catch (ErrorException $er) {
            $this->command->error($er->getMessage());
        } catch (Exception $ex) {
            $this->command->error($ex->getMessage());
        } catch (\Illuminate\Database\QueryException $qe) {
            $this->command->error($qe->getMessage());
        }
    }
}
