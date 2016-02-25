<?php

use Illuminate\Database\Seeder;

class UserBeatmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('phpbb_user_group')->delete();
            DB::table('osu_scores')->delete();
            DB::table('osu_scores_high')->delete();

            DB::table('phpbb_users')->delete();

            $datapath = base_path().'/database/data/json/';
        // USERS

        // Store saved / overwritten data in arrays
            $savedusers = [];
            $overusers = [];
            $overstats = [];
            $overhist = [];
            $overscores = [];
            $overevents = [];
            $savedbeatmaps = [];
            $savedscores = [];
            $overbeatmaps = [];
            $savedbeatmapsets = [];
            $overbeatmapsets = [];
            $error_log = [];
            $exceptions = [];
            $saveduserids = [];

            $users = json_decode(file_get_contents($datapath.'users.json'));
            foreach ($users as $u) {
                if ($existing_user = \App\Models\User::find($u->user_id)) {
                    $overusers[] = $u->user_id;
                    $existing_user->forceDelete();
                }
                $user = \App\Models\User::create([
              'username' => $u->username,
              'username_clean' => $u->username,
              'user_id' => $u->user_id,
              'user_password' => password_hash(md5('password'), PASSWORD_BCRYPT),
            ]);
                $user->save();
                $userGroup = new \App\Models\UserGroup;
                $userGroup->group_id = 5; // Admin
                $user->userGroups()->save($userGroup);
                $saveduserids[] = $u->user_id;
                $savedusers[] = $u->username;
            } // END USERS

          // STATS
          // echo 'Generating user Stats';
            $stats = json_decode(file_get_contents($datapath.'stats.json'));
            foreach ($stats as $stat) {
                // echo "\r\nSTAT: ".$stat->user_id ."/r/n";
              if ($ex = \App\Models\UserStatistics\Osu::find($stat->user_id)) {
                  $ex->forceDelete();
                  $overstats[] = $u->user_id;
              }
                try {
                    $st = \App\Models\UserStatistics\Osu::create([
                  'user_id' => $stat->user_id,
                  'count300' => $stat->count300,
                  'count100' => $stat->count100,
                  'count50' => $stat->count50,
                  'accuracy' => $stat->accuracy,
                  'accuracy_new' => $stat->accuracy,
                  'playcount' => $stat->playcount,
                  'ranked_score' => $stat->ranked_score,
                  'total_score' => $stat->total_score,
                  'x_rank_count' => $stat->x_rank_count,
                  's_rank_count' => $stat->s_rank_count,
                  'a_rank_count' => $stat->a_rank_count,
                  'rank' => $stat->rank,
                  'country_acronym' => $stat->country_acronym,
                ]);
                    $st->save();
                // echo "Saved/r/n";
                } catch (\Illuminate\Database\QueryException $e) {
                    echo ' Error: Unable to save stat';
                // echo $e->getMessage();
               $exceptions[] = $e->getMessage();
                }
              // echo 'Stat '. strval($stat->user_id) .' saved.<br>';
            }
             // END STATS

             // RANK HISTORY
            //  echo '<h3>Rank History</h3>';
               $hists = json_decode(file_get_contents($datapath.'hist.json'));
            foreach ($hists as $ht) {
                // generate user rank history
                 if ($hist = \App\Models\RankHistory::where('user_id', $ht->user_id)) {
                     $hist->delete();
                     $overhist[] = $ht->user_id;
                 }
                try {
                    $hist = new \App\Models\RankHistory;
                    $hist->user_id = $ht->user_id;
                    $hist->mode = 0;
                    for ($i = 0; $i < 90; $i++) {
                        $r = 'r'.$i;
                        $hist->$r = $ht->$r;
                    }
                    $hist->save();
                  //  echo 'Rank History for '. strval($hist->user_id) .' saved.<br>';
                } catch (\Illuminate\Database\QueryException $e) {
                    //  echo ' Error: Unable to save rank history';
                   // echo $e->getMessage();
                  $exceptions[] = $e->getMessage();
                }
            }
                // END HISTORY

            // EVENTS
                // echo '<h3>Events</h3>';
            $events = json_decode(file_get_contents($datapath.'events.json'));
            foreach ($events as $event) {
                $ev = \App\Models\Event::where('user_id', $event->user_id)->where('date', $event->date)->first();
                if ($ev) {
                    $ev->delete();
                    $overevents[] = $u->user_id;
                }
                try {
                    $ev = new \App\Models\Event;
                    $ev->user_id = $event->user_id;
                    $ev->text = $event->text;
                    $ev->text_clean = $event->text;
                    $ev->beatmap_id = $event->beatmap_id;
                    $ev->beatmapset_id = $event->beatmapset_id;
                    $ev->epicfactor = $event->epicfactor;
                    $ev->date = $event->date;

                    $ev->save();
                // echo 'Event with user id '. $event->user_id  . ' saved. ';
                } catch (\Illuminate\Database\QueryException $e) {
                    echo ' Error<br>';
                    echo $e->getMessage().'<br>';
                    $exceptions[] = $e->getMessage();
                }
            }
             // END EVENTS

             // BEATMAPS
                //  echo '<h3>Beatmaps</h3>';
             $beatmaps = json_decode(file_get_contents($datapath.'beatmaps.json'));
            foreach ($beatmaps as $bm) {
                if ($new_bm = \App\Models\Beatmap::where('beatmap_id', $bm->beatmap_id)->first()) {
                    $new_bm->delete();
                    $overbeatmaps[] = $bm->beatmap_id;
                //  echo 'Overwriting Beatmap: ';
                }
                try {
                    $new_bm = new \App\Models\Beatmap;
                    $new_bm->beatmap_id = $bm->beatmap_id;
                    $new_bm->beatmapset_id = $bm->beatmapset_id;
                    $new_bm->version = $bm->version;
                    $new_bm->total_length = $bm->total_length;
                    $new_bm->hit_length = $bm->hit_length;
                    $new_bm->countTotal = $bm->countTotal;
                    $new_bm->countNormal = $bm->countNormal;
                    $new_bm->countSlider = $bm->countSlider;
                    $new_bm->countSpinner = $bm->countSpinner;
                    $new_bm->diff_drain = $bm->diff_drain;
                    $new_bm->diff_size = $bm->diff_size;
                    $new_bm->diff_overall = $bm->diff_overall;
                    $new_bm->diff_approach = $bm->diff_approach;
                    $new_bm->playmode = $bm->playmode;
                    $new_bm->approved = $bm->approved;
                    $new_bm->difficultyrating = $bm->difficultyrating;
                    $new_bm->playcount = $bm->playcount;
                    $new_bm->passcount = $bm->passcount;

                    $new_bm->save();
                //  echo 'Saved Beatmap '. $bm->beatmap_id . ' <br>';
                $savedbeatmaps[] = $new_bm->beatmap_id;
                } catch (\Illuminate\Database\QueryException $e) {
                    //  echo ' Error: Unable to save Beatmap';
                //   echo $e->getMessage();
                 $exceptions[] = $e->getMessage();
                }
            }
              // END BEATMAPS

              // BEATMAPSETS
                  // echo '<h3>Beatmap Sets</h3>';
              $beatmapsets = json_decode(file_get_contents($datapath.'beatmapsets.json'));
            foreach ($beatmapsets as $beatmapset) {
                $set = \App\Models\BeatmapSet::where('beatmapset_id', $beatmapset->beatmapset_id)->first();
                if ($set) {
                    $set->delete();
                    $overbeatmapsets[] = $beatmapset->beatmapset_id;
                  // echo 'Overriding beatmapset: ';
                }
                try {
                    $set = new \App\Models\BeatmapSet;
                    $set->beatmapset_id = $beatmapset->beatmapset_id;
                    $set->creator = $beatmapset->creator;
                    $set->artist = $beatmapset->artist;
                    $set->title = $beatmapset->title;
                    $set->displaytitle = $beatmapset->title;
                    $set->source = $beatmapset->source;
                    $set->tags = $beatmapset->tags;
                    $set->bpm = $beatmapset->bpm;
                    $set->approved = $beatmapset->approved;
                    $set->approved_date = $beatmapset->approved_date;
                    $set->genre_id = $beatmapset->genre_id;
                    $set->language_id = $beatmapset->language_id;
                    $set->versions_available = $beatmapset->versions_available;
                    $set->difficulty_names = $beatmapset->difficulty_names;
                    $set->play_count = $beatmapset->play_count;
                    $set->favourite_count = $beatmapset->favourite_count;

                    $set->save();
                  // echo 'Beatmapset '.$beatmapset->title.  ' Saved<br>';
                  $savedbeatmapsets[] = $beatmapset->beatmapset_id;
                } catch (\Illuminate\Database\QueryException $e) {
                    echo ' Error: Unable to save Beatmap Set.';
                  // echo $e->getMessage();
                  $exceptions[] = $e->getMessage();
                }
            }
               // END BEATMAPSETS

               // SCORES
                  //  echo '<h3>Scores</h3>';
               $scores = json_decode(file_get_contents($datapath.'scores.json'));
            foreach ($scores as $score) {
                if ($existing_score = \App\Models\Score\Osu::where('user_id', $score->user_id)->where('beatmap_id', $score->beatmap_id)->first()) {
                    $existing_score->delete(); // overwrite existing score
                 $overscores[] = $score->user_id.'-'.$score->beatmap_id;
                }

                //  echo 'Over-riding: ';
                     try {
                         $sc = new \App\Models\Score\Osu;

                         $sc->user_id = $score->user_id;
                         $sc->beatmap_id = $score->beatmap_id;
                         $sc->beatmapset_id = $score->beatmapset_id;
                         $sc->score = $score->score;
                         $sc->maxcombo = $score->maxcombo;
                         $sc->rank = $score->rank;
                         $sc->count300 = $score->count300;
                         $sc->count100 = $score->count100;
                         $sc->count50 = $score->count50;
                         $sc->countgeki = $score->countgeki;
                         $sc->countmiss = $score->countmiss;
                         $sc->countkatu = $score->countkatu;
                         $sc->enabled_mods = $score->enabled_mods_val;
                         $sc->date = $score->date;

                         $sc->save();

                         $savedscores[] = $score->user_id.'-'.$score->beatmap_id;

                    //  echo 'Score saved<br>';
                     } catch (\Illuminate\Database\QueryException $e) {
                         //  echo ' Unable to save Score';
                       // echo $e->getMessage();
                       $exceptions[] = $e->getMessage();
                     }
            }
            $scores = json_decode(file_get_contents($datapath.'scores_best.json'));
            foreach ($scores as $score) {
                if ($existing_score = \App\Models\Score\Best\Osu::where('user_id', $score->user_id)->where('beatmap_id', $score->beatmap_id)->first()) {
                    $existing_score->delete(); // overwrite existing score
                 $overscores[] = 'best-'.$score->user_id.'-'.$score->beatmap_id;
                }

                //  echo 'Over-riding: ';
                     try {
                         $sc2 = new \App\Models\Score\Best\Osu;

                         $sc2->user_id = $score->user_id;
                         $sc2->beatmap_id = $score->beatmap_id;
                         $sc2->beatmapset_id = $score->beatmapset_id;
                         $sc2->score = $score->score;
                         $sc2->maxcombo = $score->maxcombo;
                         $sc2->rank = $score->rank;
                         $sc2->count300 = $score->count300;
                         $sc2->count100 = $score->count100;
                         $sc2->count50 = $score->count50;
                         $sc2->countgeki = $score->countgeki;
                         $sc2->countmiss = $score->countmiss;
                         $sc2->countkatu = $score->countkatu;
                         $sc2->enabled_mods = $score->enabled_mods_val;
                         $sc2->date = $score->date;
                         $sc2->pp = $score->pp;

                         $sc2->save();

                         $savedscores[] = 'best-'.$score->user_id.'-'.$score->beatmap_id;

                    //  echo 'Score saved<br>';
                     } catch (\Illuminate\Database\QueryException $e) {
                         //  echo ' Unable to save Score';
                       // echo $e->getMessage();
                       $exceptions[] = $e->getMessage();
                     }
            }
                // END SCORES

        // LOG FILE / MESSAGES
          $log_contents = "======Summary=====\n".'Saved Users and stats for: '.implode(', ', $savedusers)
               ." \n Saved ".strval(count($savedbeatmaps)).' Beatmaps'
               ." \n Saved ".strval(count($savedbeatmapsets)).' Beatmapsets.  '
               ." \n ERRORS: ".strval(count($exceptions))
                ." \n Database Entries Overwritten: ".count($overusers).' Users, '.count($overstats).' User Stats, '.count($overevents).' Events, '.count($overhist).' Rank Histories, '
                .count($overscores).' Scores, '.count($overbeatmaps).' Beatmaps, '.count($overbeatmapsets).' Beatmap Sets. See /database/data/importlog.txt for details.'
                ."\n =====ERRORS (".strval(count($exceptions)).")======\n".implode("\r\n ", $exceptions)
                ."\n =====Overwritten Users======\n".implode(', ', $overusers)
                ."\n\n=====Overwritten Stats=====\n".implode(', ', $overstats)
                ."\n\n=====Overwritten Rank Histories=====\n".implode(', ', $overhist)
                ."\n\n=====Overwritten Events=====\n".implode(', ', $overevents)
                ."\n\n=====Overwritten Scores=====\n".implode(', ', $overscores)
                ."\n\n=====Saved Scores=====\n".implode(', ', $savedscores)
                ."\n\n=====Saved Beatmaps=====\n".implode(', ', $savedbeatmaps)
                ."\n\n=====Overwritten Beatmaps=====\n".implode(', ', $overbeatmaps)
                ."\n\n=====Saved Beatmapsets=====\n".implode(', ', $savedbeatmapsets)
                ."\n\n=====Overwritten Beatmapsets=====\n".implode(', ', $overbeatmapsets);

            file_put_contents($datapath.'log.txt', $log_contents);

            if (count($exceptions) > 0) {
                echo "== THERE WERE ERRORS IMPORTING USERS/BEATMAP DATA. CHECK /database/data/LOG.TXT FOR THE ERRORS\r\n";
            }
            echo 'Saved Usernames: '.implode(', ', $savedusers);
            echo "\r\n || Saved ".strval(count($savedbeatmaps)).' Beatmaps ||';
            echo " \r\n|| Saved ".strval(count($savedbeatmapsets)).' Beatmapsets.  || ';
            echo " \r\n|| Number of Database Entries Overwritten: ".count($overusers).' Users, '.count($overstats)
          .' User Stats, '.count($overevents).' Events, '.count($overhist).' Rank Histories, '
            .count($overscores).' Scores, '.count($overbeatmaps).' Beatmaps, '.count($overbeatmapsets)
             ." Beatmap Sets. \r\n Log of imported entries saved to /database/data/json/importlog.txt.\r\n";
        } catch (\Illuminate\Database\QueryException $e) {
            echo "Error: Unable to save User Profile Data\r\n".$e->getMessage();
        } catch (Exception $ex) {
            echo "Error: Unable to save User Profile Data\r\n".$ex->getMessage();
        }
    }
}
