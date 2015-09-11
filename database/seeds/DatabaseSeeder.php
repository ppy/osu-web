<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(App\Models\User::class, 5)
            ->create()
            ->each(function (App\Models\User $user){
                $set = factory(App\Models\BeatmapSet::class)->make();
                $maps = factory(App\Models\Beatmap::class, 4)->make();
                $beatmaps->each(function (Beatmap $beatmap) use ($set) {
                    $beatmap->set()->associate($set);
                });
                $user->sets()->save($set);
            });
    }
}
