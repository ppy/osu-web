<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

                // technically shouldn't exist if new...
                if (!array_key_exists($beatmapset->beatmapset_id, $sets)) {
                    $sets[$beatmapset->beatmapset_id] = [];
                }
                $newBeatmapsetsCount++;
            }
            $this->beatmapsets[$beatmapset->beatmapset_id] = $beatmapset;

            if ($beatmap === null) {
                $beatmap = $this->createBeatmap($item);

                // don't bother checking if it exists, just add it.
                $sets[$beatmap->beatmapset_id][] = $beatmap->beatmap_id;
                $newBeatmapsCount++;
            }
            $this->beatmaps[$beatmap->beatmap_id] = $beatmap;

            $this->createFailtimes($beatmap);
            $this->createDifficulty($beatmap);
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

    private function createBeatmap($json)
    {
        return Beatmap::create([
            'beatmap_id' => $json->beatmap_id,
            'beatmapset_id' => $json->beatmapset_id,
            'filename' => $json->beatmapset_id.' '.$json->artist.' - '.$json->title.'.osz',
            'checksum' => $json->file_md5,
            'version' => $json->version,
            'total_length' => $json->total_length,
            'hit_length' => $json->hit_length,
            'bpm' => $json->bpm,
            'countNormal' => round(intval($json->max_combo) - (0.2 * intval($json->max_combo))),
            'countSlider' => round(intval($json->max_combo) - (0.8 * intval($json->max_combo))),
            'countSpinner' => 1,
            'diff_drain' => $json->diff_drain,
            'diff_size' => $json->diff_size,
            'diff_overall' => $json->diff_overall,
            'diff_approach' => $json->diff_approach,
            'playmode' => $json->mode,
            'approved' => $json->approved,
            'difficultyrating' => $json->difficultyrating,
            'playcount' => $json->playcount,
            'passcount' => $json->passcount,
            'user_id' => $this->randomUser()['user_id'],
        ]);
    }

    private function createBeatmapset($json)
    {
        return Beatmapset::create([
            'beatmapset_id' => $json->beatmapset_id,
            'creator' => $json->creator,
            'artist' => $json->artist,
            'title' => $json->title,
            'displaytitle' => $json->title,
            'source' => $json->source,
            'tags' => $json->tags,
            'bpm' => $json->bpm,
            'approved' => $json->approved,
            'approved_date' => $json->approved_date,
            'genre_id' => $json->genre_id,
            'language_id' => $json->language_id,
            'versions_available' => 1,
            'difficulty_names' => '',
            'play_count' => 0,
            'favourite_count' => $json->favourite_count,
            'user_id' => $this->randomUser()['user_id'],
            'submit_date' => Carbon::now(),
        ]);
    }

    private function createFailtimes($beatmap)
    {
        // Generating the beatmap failtimes
        // just delete all the old ones and create new ones.
        BeatmapFailtimes::where('beatmap_id', $beatmap->beatmap_id)->delete();

        $beatmap->failtimes()->saveMany([
            factory(App\Models\BeatmapFailtimes::class)->states('fail')->make(),
            factory(App\Models\BeatmapFailtimes::class)->states('retry')->make(),
        ]);
    }

    private function createDifficulty($beatmap)
    {
        // Generating the beatmap difficulties
        // just delete all the old ones and create new ones.
        BeatmapDifficulty::where('beatmap_id', $beatmap->beatmap_id)->delete();

        if ($beatmap->playmode !== Beatmap::MODES['osu']) {
            $modes = [$beatmap->playmode];
        } else {
            $modes = array_values(Beatmap::MODES);
        }

        foreach ($modes as $mode) {
            // fuzz the ratings for converts a little.
            // TODO: should probably update the endpoint the seeder uses to
            //  include per-mode difficulties later.
            $diff_unified = $mode === $beatmap->playmode
                ? $beatmap->difficultyrating
                : $beatmap->difficultyrating + rand(-1000, 1000) / 10000;

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
            $users = User::all()->toArray();

            if (count($users) < 1) {
                $users = [['user_id' => 1]];
            }
        }

        return array_rand_val($users);
    }
}
