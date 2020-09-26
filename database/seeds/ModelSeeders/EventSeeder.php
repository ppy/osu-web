<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // DB::table('osu_events')->delete();
        App\Models\Event::unguard();

        $beatmapCount = App\Models\Beatmap::count();
        if ($beatmapCount === 0) {
            $this->command->info('Can\'t seed events due to having no beatmap data.');

            return;
        }

        $faker = Faker::create();
        $users = App\Models\User::all();

        $generateEventText = function ($bm, $bms, $u, $rank) {
            switch ($bm->playmode) {
                case 0:
                    $playmode = 'osu!';
                    break;
                case 1:
                    $playmode = 'Taiko';
                    break;
                case 2:
                    $playmode = 'Catch the Beat';
                    break;
                case 3:
                    $playmode = 'osu!mania';
                    break;
            }
            $rank_letters = ['X', 'S', 'A'];
            $rank_letter = array_rand_val($rank_letters);

            $string = "<img src='/images/".$rank_letter."_small.png'/> <b><a href='/u/".$u->user_id."'>".$u->username.'</a></b> achieved rank #'
                .$rank." on <a href='/b/".$bm->beatmap_id."?m=0'>".$bms->artist.' - '.$bms->title
                .' ['.$bm->version.']'.'</a> ('.$playmode.')';

            return $string;
        };

        foreach ($users as $u) {
            if ($beatmapCount > 0) {
                $all_beatmaps = App\Models\Beatmap::orderByRaw('RAND()')->get();
                for ($c = 0; $c < 4; $c++) {
                    if ($all_beatmaps[$c]) {
                        $bm = $all_beatmaps[$c];
                        $bms = App\Models\Beatmapset::find($bm->beatmapset_id);
                        if (isset($bms)) {
                            $is_rank_1 = $faker->boolean(20);
                            if ($is_rank_1 === true) {
                                $rank = 1;
                                $epicfactor = 2;
                            } else {
                                $rank = strval(rand(1, 499));
                                $epicfactor = 1;
                            }
                            $txt = $generateEventText($bm, $bms, $u, $rank);
                            $ev = $u->events()->save(App\Models\Event::create([
                                'user_id' => $u->user_id,
                                'text' => $txt,
                                'text_clean' => $txt,
                                'epicfactor' => $epicfactor,
                                'beatmap_id' => $bm->beatmap_id,
                                'beatmapset_id' => $bm->beatmapset_id,
                                'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now
                            ]));
                        }
                    }
                }
            } // end rank events

            // Create a random supporter/name change event
            $string = '';
            switch (rand(1, 4)) {
                case 1:
                    $string = "<b><a href='/u/".$u->user_id."'>".$u->username.'</a></b> has once again chosen to support osu! - thanks for your generosity!';
                    break;
                case 2:
                    $string = "<b><a href='/u/".$u->user_id."'>".$u->username.'</a></b> has become an osu! supporter - thanks for your generosity!';
                    break;
                case 3:
                    $string = "<b><a href='/u/".$u->user_id."'>".$u->username.'</a></b> has received the gift of osu! supporter!';
                    break;
                case 4:
                    $string = "<b><a href='/u/".$u->user_id."'>".$faker->userName.'</a></b> has changed their username to '.$u->username.'!';
                    break;
            }
            $ev2 = $u->events()->save(App\Models\Event::create([
                'user_id' => $u->user_id,
                'text' => $string,
                'text_clean' => $string,
                'epicfactor' => 1,
                'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now
            ]));
        }

        // END EVENTS
        App\Models\Event::reguard();
    }
}
