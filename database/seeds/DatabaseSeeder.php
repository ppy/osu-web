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
    }

    public function runUserBeatmapSeeder(){
      $zip = new ZipArchive;
      $datapath = base_path().'/database/data/';
      $res = $zip->open($datapath.'jsondata.zip');

      if ($res === TRUE) {

        $zip->extractTo($datapath.'/json/');
        $zip->close();
        $this->command->info('Unzipped Data files');
        $this->command->info('Seeding Users, User Ranks & Stats, Beatmaps and Beatmapsets...');

        $this->call(UserBeatmapSeeder::class);

      } else {
        $this->command->info('Error: Users and Beatmaps not seeded. Couldnt unzip database/data/jsondata.zip. Does the file exist?');
      }
    }
}
