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

            // FAVOURITE BEATMAPS AND BEATMAP PLAYCOUNTS FOR EACH USER

            foreach (App\Models\User::all()as $usr) {
                $bms = $usr->scoresBestOsu()->get();
                if (count($bms) < 1) {
                    $this->command->info('Can\'t seed favourite maps, map playcounts or leaders due to having no beatmap data.');

                    return;
                }
                $usr_id = $usr->user_id;

                foreach ($bms as $bm) {
                    DB::table('osu_favouritemaps')->where('user_id', $usr_id)->where('beatmapset_id', $bm['beatmapset_id'])->delete();
                    $fav = new App\Models\FavouriteBeatmapset;
                    $fav->beatmapset_id = $bm['beatmapset_id'];
                    $fav->user_id = $usr_id;
                    $fav->save();

                    // Add a random couple few first place ranks

                    $bm = $bms[rand(0, count($bms) - 1)];
                    DB::table('osu_user_beatmap_playcount')->where('user_id', $usr_id)->where('beatmap_id', $bm['beatmap_id'])->delete();
                    $playcount = new App\Models\BeatmapPlaycount;

                    $playcount->user_id = $usr_id;
                    $playcount->beatmap_id = $bm['beatmap_id'];
                    $playcount->playcount = rand(0, 1500);
                    $playcount->save();

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
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->command->error("Error: Unable to save User Profile Data\r\n".$e->getMessage());
        } catch (Exception $ex) {
            $this->command->error("Error: Unable to save User Profile Data\r\n".$ex->getMessage());
        }
    }
}
