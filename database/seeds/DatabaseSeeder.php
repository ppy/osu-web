<?php

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
            // Users, Stats, Ranks
            $this->command->info('Seeding Users and Stats/Rank History...');
            $this->call(UserSeeder::class);

            // Beatmaps and sets
            $this->command->info('Seeding Beatmaps...');
            $this->call(BeatmapSeeder::class);

            // Events
            $this->command->info('Seeding Events...');
            $this->call(EventSeeder::class);

            // Scores
            $this->command->info('Seeding Scores...');
            $this->call(ScoreSeeder::class);

            // Forums, topics, posts etc
            $this->command->info('Seeding Forum Data...');
            $this->call(ForumSeeder::class);

            // Users Profile Data (Favourite maps, First place ranks, Playcounts)
            $this->command->info('Seeding Users Profile Data (e.g. favourite maps, first place ranks, playcounts)');
            $this->call(UserProfileSeeder::class);

            // Miscellaneous Data (e.g. counts)
            $this->command->info('Seeding Miscellaneous Data');
            $this->call(MiscSeeder::class);
        } catch (ErrorException $er) {
            $this->command->error($er->getMessage());
        } catch (Exception $ex) {
            $this->command->error($ex->getMessage());
        } catch (\Illuminate\Database\QueryException $qe) {
            $this->command->error($qe->getMessage());
        }
    }
}
