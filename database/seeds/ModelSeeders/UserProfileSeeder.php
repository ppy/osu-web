<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // DB::table('osu_favouritemaps')->delete();
            // DB::table('osu_user_beatmap_playcount')->delete();
            // DB::table('osu_leaders')->delete();

            $allusers = App\Models\User::all()->toArray();
            $userids = [];
            for ($ct = 0; $ct < count($allusers); $ct++) {
                $userids[] = $allusers[$ct]['user_id'];
            }

            foreach (App\Models\User::all()as $usr) {
                $usr_id = $usr->user_id;

                // FAVOURITES
                $someMaps = App\Models\Beatmapset::take(6)->get();
                foreach ($someMaps as $favmap) {
                    DB::table('osu_favouritemaps')->where('user_id', $usr_id)->where('beatmapset_id', $favmap['beatmapset_id'])->delete();
                    $fav = new App\Models\FavouriteBeatmapSet;
                    $fav->beatmapset_id = $favmap['beatmapset_id'];
                    $fav->user_id = $usr_id;
                    $fav->save();
                }
                // END FAVOURITES

                $bms = $usr->scoresBestOsu()->get();
                if (count($bms) < 1) {
                    $this->command->info('Can\'t seed favourite maps, map playcounts or leaders due to having no beatmap data.');

                    return;
                }

                foreach ($bms as $bm) {
                    $bm = $bms[rand(0, count($bms) - 1)];
                    DB::table('osu_user_beatmap_playcount')->where('user_id', $usr_id)->where('beatmap_id', $bm['beatmap_id'])->delete();

                    // USER BEATMAP PLAYCOUNTS
                    $playcount = new App\Models\BeatmapPlaycount;

                    $playcount->user_id = $usr_id;
                    $playcount->beatmap_id = $bm['beatmap_id'];
                    $playcount->playcount = rand(0, 1500);
                    $playcount->save();
                    // END USER BEATMAP PLAYCOUNTS

                    // FIRST PLACE RANKS
                    $bm = $bms[rand(0, count($bms) - 1)];
                    if (DB::table('osu_leaders')->where('beatmap_id', $bm['beatmap_id'])->first()) {
                        $bm = $bms[rand(0, count($bms) - 1)];
                        // try once more
                        if (DB::table('osu_leaders')->where('beatmap_id', $bm['beatmap_id'])->first()) {
                            DB::table('osu_leaders')->where('beatmap_id', $bm['beatmap_id'])->delete();
                        }
                    }
                    $leader = new App\Models\BeatmapLeader\Osu;
                    $leader->beatmap_id = $bm['beatmap_id'];
                    $leader->user_id = $usr_id;
                    $leader->score_id = $bm['score_id'];
                    $leader->save();
                    // END FIRST PLACE RANKS

                    // ACHIEVEMENTS
                    DB::table('osu_user_achievements')->where('user_id', $usr_id)->delete();
                    $achs = App\Models\Achievement::all();

                    foreach ($achs as $ach) {
                        // 50% of obtaining each achievement
                        if (rand(0, 1) === 1) {
                            DB::table('osu_user_achievements')->insert([
                                'user_id' => $usr_id,
                                'achievement_id' => $ach->achievement_id,
                            ]);
                        }
                    }
                    // END ACHIEVEMENTS

                    // PROFILE COVERS
                    DB::table('user_profile_customizations')->where('user_id', $usr_id)->delete();
                    DB::table('user_profile_customizations')->insert([
                        'user_id' => $usr_id,
                        'cover_json' => '{"id":"'.rand(1, 8).'","file":null}',
                    ]);
                    // END PROFILE COVERS
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->command->error("Error: Unable to save User Profile Data\r\n".$e->getMessage());
        } catch (Exception $ex) {
            $this->command->error("Error: Unable to save User Profile Data\r\n".$ex->getMessage());
        }
    }
}
