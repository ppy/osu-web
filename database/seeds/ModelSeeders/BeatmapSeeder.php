<?php

use App\Models\Beatmap;
use App\Models\BeatmapDifficulty;
use App\Models\BeatmapFailtimes;
use App\Models\Beatmapset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BeatmapSeeder extends Seeder
{
    // store some state to cut down querying
    private $beatmapsets = [];
    private $beatmaps = [];
    private $existingMaps = [];
    private $existingSets = [];


    private function createBeatmapset($json)
    {
        $beatmapset = new Beatmapset();
        $beatmapset->beatmapset_id = $json->beatmapset_id;
        $beatmapset->creator = $json->creator;
        $beatmapset->artist = $json->artist;
        $beatmapset->title = $json->title;
        $beatmapset->displaytitle = $json->title;
        $beatmapset->source = $json->source;
        $beatmapset->tags = $json->tags;
        $beatmapset->bpm = $json->bpm;
        $beatmapset->approved = $json->approved;
        $beatmapset->approved_date = $json->approved_date;
        $beatmapset->genre_id = $json->genre_id;
        $beatmapset->language_id = $json->language_id;
        $beatmapset->versions_available = 1;
        $beatmapset->difficulty_names = '';
        $beatmapset->play_count = 0;
        $beatmapset->favourite_count = $json->favourite_count;
        $beatmapset->user_id = $this->randomUser()['user_id'];
        $beatmapset->submit_date = Carbon::now();

        return $beatmapset;
    }

    private function createBeatmap($json)
    {
        $beatmap = new Beatmap();
        $beatmap->beatmap_id = $json->beatmap_id;
        $beatmap->beatmapset_id = $json->beatmapset_id;
        $beatmap->filename = $json->beatmapset_id.' '.$json->artist.' - '.$json->title.'.osz';
        $beatmap->checksum = $json->file_md5;
        $beatmap->version = $json->version;
        $beatmap->total_length = $json->total_length;
        $beatmap->hit_length = $json->hit_length;
        $beatmap->countTotal = $json->max_combo !== null ? $json->max_combo : 1500;
        $beatmap->countNormal = round(intval($json->max_combo) - (0.2 * intval($json->max_combo)));
        $beatmap->countSlider = round(intval($json->max_combo) - (0.8 * intval($json->max_combo)));
        $beatmap->countSpinner = 1;
        $beatmap->diff_drain = $json->diff_drain;
        $beatmap->diff_size = $json->diff_size;
        $beatmap->diff_overall = $json->diff_overall;
        $beatmap->diff_approach = $json->diff_approach;
        $beatmap->playmode = $json->mode;
        $beatmap->approved = $json->approved;
        $beatmap->difficultyrating = $json->difficultyrating;
        $beatmap->playcount = $json->playcount;
        $beatmap->passcount = $json->passcount;
        $beatmap->user_id = $this->randomUser()['user_id'];

        return $beatmap;
    }

    private function createBeatmapFailtimes($beatmap)
    {
        // Generating the beatmap failtimes
        // just delete all the old ones and create new ones.
        BeatmapFailtimes::where('beatmap_id', $beatmap->beatmap_id)->delete();

        $beatmap->failtimes()->saveMany([
            factory(App\Models\BeatmapFailtimes::class, 'fail')->make(),
            factory(App\Models\BeatmapFailtimes::class, 'retry')->make(),
        ]);
    }

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

        // get beatmaps
        try {
            $json = json_decode(file_get_contents($base_url.'get_beatmaps?since=2016-01-01%2000:00:00'.$api));
        } catch (Exception $ex) {
            $this->command->error('Unable to fetch Beatmap data');
            $this->command->error($ex->getMessage());

            return;
        }

        $sets = $this->populateExisting($json);

        foreach ($json as $item) {
            $beatmapset = $this->existingSets[$item->beatmapset_id] ?? null;
            $beatmap = $this->existingMaps[$item->beatmap_id] ?? null;

            if ($beatmapset === null) {
                $beatmapset = $this->createBeatmapset($item);
                $beatmapset->save();
            }
            $this->beatmapsets[$beatmapset->beatmapset_id] = $beatmapset;

            if ($beatmap === null) {
                $beatmap = $this->createBeatmap($item);
                $beatmap->save();
            }
            $this->beatmaps[$beatmap->beatmap_id] = $beatmap;

            $this->createBeatmapFailtimes($beatmap);
        }

        foreach ($sets as $setId => $mapIds) {
            $setPlaycount = 0;
            $names = [];
            foreach ($mapIds as $mapId) {
                $beatmap = $this->beatmaps[$mapId];
                $setPlaycount += $beatmap->playcount;
                $names[] = $beatmap->version.'@'.$beatmap->mode;
            }

            // continue;
            $beatmapset = $this->existingSets[$setId];
            $beatmapset->versions_available = count($mapIds);
            $beatmapset->play_count = $setPlaycount;
            $beatmapset->difficulty_names = implode(',', $names);
            $beatmapset->save();
        }


        //     $this->command->info('Saved '.strval(count($beatmaps_array)).' Beatmaps (Overwritten '.strval(count($overbeatmaps)).').');
        //     $this->command->info('Saved '.strval(count($beatmapset_array)).' Beatmap Sets (Overwritten '.strval(count($overbeatmapsets)).').');
        // } catch (\Illuminate\Database\QueryException $e) {
        //     $this->command->error("DB Error: Unable to save Beatmap Data\r\n".$e->getMessage());
        // } catch (Exception $ex) {
        //     $this->command->error("Error: Unable to save Beatmap Data\r\n".$ex->getMessage());
        // }
    }

    private function createDifficulty($beatmap)
    {
        if ($beatmap->mode !== 0) {
            $modes = [$beatmap->mode];
        } else {
            $modes = [0, 1, 2, 3];
        }

        foreach ($modes as $mode) {
            // fuzz the ratings for converts a little.
            $diff_unified = $mode === $beatmap->mode
                ? $beatmap->difficultyrating
                : $rand(-10000, 10000) / 10000;

            if ($diff_unified < 0) {
                $diff_unified = rand(1, 10000) / 10000;
            }

            BeatmapDifficulty::create([
                'beatmap_id' => $beatmap->beatmap_id,
                'mode' => $mode,
                'mods' => 0,
                'diff_unified' => $diff_unified,
            ]);
        }
    }

    private function populateExisting(array $beatmaps)
    {
        // grind some numbers
        $sets = [];
        foreach ($beatmaps as $bm) {
            $ids = $sets[$bm->beatmapset_id] ?? null;
            if ($ids === null) {
                $sets[$bm->beatmapset_id] = [];
            }

            $sets[$bm->beatmapset_id][] = $bm->beatmap_id;
        }

        // get existing
        $beatmapsetIds = array_keys($sets);
        $beatmapIds = array_flatten(array_values($sets));

        $this->existingSets = [];
        $beatmapsets = Beatmapset::withoutGlobalScopes()->whereIn('beatmapset_id', $beatmapsetIds)->get();
        foreach ($beatmapsets as $beatmapset) {
            $this->existingSets[$beatmapset->beatmapset_id] = $beatmapset;
        }

        $this->existingMaps = [];
        $beatmaps = Beatmap::withoutGlobalScopes()->whereIn('beatmap_id', $beatmapIds)->get();
        foreach ($beatmaps as $beatmap) {
            $this->existingMaps[$beatmap->beatmap_id] = $beatmap;
        }

        return $sets;
    }

    private function randomUser()
    {
        static $users;
        if ($users === null) {
            $users = User::orderByRaw('RAND()')->get()->toArray();

            if (count($users) < 1) {
                $users = [['user_id' => 1]];
            }
        }

        return array_rand_val($users);
    }
}
