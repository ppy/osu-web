<?php

use Illuminate\Database\Seeder;

class BeatmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beatmaps_array = [];
        $beatmapset_array = [];
        $overbeatmaps = [];
        $overbeatmapsets = [];

        $base_url = 'https://osu.ppy.sh/api/';
        $api_key = env('OSU_API_KEY', null);
        if (empty($api_key)) {
            $this->command->error('Error: No OSU_API_KEY value set in .env file. Can\'t seed beatmap data!');

            return;
        }
        $api = '&k='.$api_key;
        $users = App\Models\User::orderByRaw('RAND()')->get()->toArray();
        if (count($users) < 1) {
            $users = [['user_id' => 1]];
        }

        try {
            $beatmaps = json_decode(file_get_contents($base_url.'get_beatmaps?since=2016-01-01%2000:00:00'.$api));
            $last_beatmapset = null;
            $beatmap_diff_names = [];
            $beatmapset_versions = 0;
            $set_playcount = 0;
            $number_of_beatmaps = count($beatmaps);
            $i = 0;
            $first_map = true;
            $last_map = false;

            foreach ($beatmaps as $bm) {
                $make_new_set = false;
                if ($i === $number_of_beatmaps - 1) {
                    $make_new_set = true;
                    $last_map = true;
                }

                // Here we are going to check if the current beatmap belongs to a new set, and make the set if necessary
                if ($last_beatmapset === $bm->beatmapset_id || $first_map === true) {
                    ++$beatmapset_versions;
                    $beatmap_diff_names[] = $bm->version.'@'.$bm->mode;
                    $set_playcount += $bm->playcount;
                } else {
                    $make_new_set = true;
                }
                if ($make_new_set === true) {
                    if ($last_map === true) {
                        $the_beatmap = $bm;
                    } else {
                        $the_beatmap = $previous_beatmap;
                    }
                    // Create new beatmapset
                    $set = \App\Models\BeatmapSet::where('beatmapset_id', $the_beatmap->beatmapset_id)->first();
                    if ($set) {
                        $set->delete();
                        $overbeatmapsets[] = $the_beatmap->beatmapset_id;
                    }
                    $beatmap_diff_names = implode(',', $beatmap_diff_names);
                    $set = new \App\Models\BeatmapSet;
                    $set->beatmapset_id = $the_beatmap->beatmapset_id;
                    $set->creator = $the_beatmap->creator;
                    $set->artist = $the_beatmap->artist;
                    $set->title = $the_beatmap->title;
                    $set->displaytitle = $the_beatmap->title;
                    $set->source = $the_beatmap->source;
                    $set->tags = $the_beatmap->tags;
                    $set->bpm = $the_beatmap->bpm;
                    $set->approved = $the_beatmap->approved;
                    $set->approved_date = $the_beatmap->approved_date;
                    $set->genre_id = $the_beatmap->genre_id;
                    $set->language_id = $the_beatmap->language_id;
                    $set->versions_available = $beatmapset_versions;
                    $set->difficulty_names = $beatmap_diff_names;
                    $set->play_count = $set_playcount;
                    $set->favourite_count = $the_beatmap->favourite_count;
                    $set->user_id = array_rand_val($users)['user_id'];
                    $set->save();

                    $set->difficulty_names = $beatmap_diff_names;
                    $beatmapset_array[] = $set;

                    $set_playcount = $bm->playcount;
                    $beatmapset_versions = 1;
                    $beatmap_diff_names = [$bm->version.'@'.$bm->mode];
                }

                if ($new_bm = \App\Models\Beatmap::where('beatmap_id', $bm->beatmap_id)->first()) {
                    $new_bm->delete();
                    $overbeatmaps[] = $new_bm;
                }
                $new_bm = new \App\Models\Beatmap;
                $new_bm->beatmap_id = $bm->beatmap_id;
                $new_bm->beatmapset_id = $bm->beatmapset_id;
                $new_bm->filename = $bm->beatmapset_id.' '.$bm->artist.' - '.$bm->title.'.osz';
                $new_bm->checksum = $bm->file_md5;
                $new_bm->version = $bm->version;
                $new_bm->total_length = $bm->total_length;
                $new_bm->hit_length = $bm->hit_length;
                $new_bm->countTotal = $bm->max_combo !== null ? $bm->max_combo : 1500;
                $new_bm->countNormal = round(intval($bm->max_combo) - (0.2 * intval($bm->max_combo)));
                $new_bm->countSlider = round(intval($bm->max_combo) - (0.8 * intval($bm->max_combo))) - 1;
                $new_bm->countSpinner = 1;
                $new_bm->diff_drain = $bm->diff_drain;
                $new_bm->diff_size = $bm->diff_size;
                $new_bm->diff_overall = $bm->diff_overall;
                $new_bm->diff_approach = $bm->diff_approach;
                $new_bm->playmode = $bm->mode;
                $new_bm->approved = $bm->approved;
                $new_bm->difficultyrating = $bm->difficultyrating;
                $new_bm->playcount = $bm->playcount;
                $new_bm->passcount = $bm->passcount;
                $new_bm->user_id = array_rand_val($users)['user_id'];
                $new_bm->save();

                $beatmaps_array[] = $new_bm;

                if ($first_map === true) {
                    $first_map = false;
                }
                $last_beatmapset = $bm->beatmapset_id;
                $previous_beatmap = $bm;
                ++$i;
            } // end foreach beatmap

            $this->command->info('Saved '.strval(count($beatmaps_array)).' Beatmaps (Overwritten '.strval(count($overbeatmaps)).').');
            $this->command->info('Saved '.strval(count($beatmapset_array)).' Beatmap Sets (Overwritten '.strval(count($overbeatmapsets)).').');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->command->error("DB Error: Unable to save Beatmap Data\r\n".$e->getMessage());
        } catch (Exception $ex) {
            $this->command->error("Error: Unable to save Beatmap Data\r\n".$ex->getMessage());
        }
    }
}
