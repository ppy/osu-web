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

      // Users, Stats, Ranks, Scores, Events and Beatmaps/sets
          $this->command->info('Seeding Users, Stats and Beatmaps using zip data...');
        $this->runUserBeatmapSeeder();

     // Forums, topics, posts etc
          $this->command->info('Seeding Forum Data...');
        $this->call(ForumSeeder::class);

      // Users Profile Data (e.g. favourite maps, first place ranks, playcounts)
          $this->command->info('Seeding Users Profile Data (e.g. favourite maps, first place ranks, playcounts)');
        $this->call(UserProfileSeeder::class);

      // Miscellaneous Data (e.g. counts)
          $this->command->info('Seeding Miscellaneous Data');
        $this->call(MiscSeeder::class);
    }

    public function runUserBeatmapSeeder()
    {
        $datapath = base_path().'/database/data/json/';

        $filelist = [$datapath.'beatmaps.json', $datapath.'beatmapsets.json', $datapath.'events.json', $datapath.'hist.json', $datapath.'scores_best.json', $datapath.'scores.json', $datapath.'stats.json', $datapath.'users.json'];
        foreach ($filelist as $file) {
            if (!file_exists($file)) {
                $this->command->error('Error: Couldnt find json file at '.$file.' required for seeding UserBeatmapSeeder');
            }
        }
    }
}
