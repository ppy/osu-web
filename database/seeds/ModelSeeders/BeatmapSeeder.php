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
    private $beatmaps = [];
    private $beatmapsets = [];


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
        if ($this->command) {
            $this->command->info('Seeding Beatmaps, this may take a while...');
        }

        $newBeatmapsetsCount = 0;
        $newBeatmapsCount = 0;

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
            if ($this->command) {
                $this->command->error('Unable to fetch Beatmap data');
                $this->command->error($ex->getMessage());

                return;
            }

            throw $ex;
        }

        $sets = $this->populateExisting($json);

        foreach ($json as $item) {
            $beatmapset = $this->beatmapsets[$item->beatmapset_id] ?? null;
            $beatmap = $this->beatmaps[$item->beatmap_id] ?? null;

            if ($beatmapset === null) {
                $beatmapset = $this->createBeatmapset($item);
                $beatmapset->save();

                // technically shouldn't exist if new...
                if (!array_key_exists($beatmapset->beatmapset_id, $sets)) {
                    $sets[$beatmapset->beatmapset_id] = [];
                }
                $newBeatmapsetsCount++;
            }
            $this->beatmapsets[$beatmapset->beatmapset_id] = $beatmapset;

            if ($beatmap === null) {
                $beatmap = $this->createBeatmap($item);
                $beatmap->save();

                // don't bother checking if it exists, just add it.
                $sets[$beatmap->beatmapset_id][] = $beatmap->beatmap_id;
                $newBeatmapsCount++;
            }
            $this->beatmaps[$beatmap->beatmap_id] = $beatmap;

            $this->createBeatmapFailtimes($beatmap);
        }

        foreach ($sets as $setId => $mapIds) {
            $uniqueMapIds = array_unique($mapIds);
            $setPlaycount = 0;
            $names = [];
            foreach ($uniqueMapIds as $mapId) {
                $beatmap = $this->beatmaps[$mapId];
                $setPlaycount += $beatmap->playcount;
                $names[] = $beatmap->version.'@'.$beatmap->playmode;
            }

            $beatmapset = $this->beatmapsets[$setId];
            $beatmapset->versions_available = count($uniqueMapIds);
            $beatmapset->play_count = $setPlaycount;
            $beatmapset->difficulty_names = implode(',', $names);
            $beatmapset->save();
        }

        $updatedBeatmapsetsCount = count($this->beatmapsets) - $newBeatmapsetsCount;
        $updatedBeatmapsCount = count($this->beatmaps) - $newBeatmapsCount;

        if ($this->command) {
            $this->command->info("Beatmap Sets: {$updatedBeatmapsetsCount} updated, {$newBeatmapsetsCount} new.");
            $this->command->info("Beatmaps: {$updatedBeatmapsCount} updated, {$newBeatmapsCount} new.");
        }
    }

    private function createDifficulty($beatmap)
    {
        if ($beatmap->playmode !== Beatmap::MODE['osu']) {
            $modes = [$beatmap->playmode];
        } else {
            $modes = array_values(Beatmap::MODES);
        }

        foreach ($modes as $mode) {
            // fuzz the ratings for converts a little.
            $diff_unified = $mode === $beatmap->playmode
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

        $this->beatmapsets = [];
        $beatmapsets = Beatmapset::withoutGlobalScopes()->whereIn('beatmapset_id', $beatmapsetIds)->get();
        foreach ($beatmapsets as $beatmapset) {
            $this->beatmapsets[$beatmapset->beatmapset_id] = $beatmapset;
        }

        $this->beatmaps = [];
        $beatmaps = Beatmap::withoutGlobalScopes()->whereIn('beatmap_id', $beatmapIds)->get();
        foreach ($beatmaps as $beatmap) {
            $this->beatmaps[$beatmap->beatmap_id] = $beatmap;
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
