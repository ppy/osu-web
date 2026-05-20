<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\BeatmapPlaycount;
use App\Models\FavouriteBeatmapset;
use App\Models\Score\Best as ScoreBest;
use App\Models\User;
use DB;
use Ds\Set;
use Exception;
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
            foreach (User::all() as $user) {
                $this->fillUserProfile($user);
            }
        } catch (Exception $ex) {
            $this->command->error('Error: Unable to save User Profile Data'.PHP_EOL.$ex->getMessage());
        }
    }

    // Add favourite beatmaps, beatmap playcounts, and first places for each user
    private function fillUserProfile(User $user)
    {
        $scores = ScoreBest\Osu::where(['user_id' => $user->getKey()])->get();

        if (count($scores) < 1) {
            $this->command->info('Can\'t seed favourite maps, map playcounts or leaders due to having no score data.');

            return;
        }

        $userId = $user->getKey();
        FavouriteBeatmapset::where(['user_id' => $userId])->delete();
        BeatmapPlaycount::where(['user_id' => $userId])->delete();
        $favouritedBeatmapsetIds = new Set();

        foreach ($scores as $score) {
            $beatmapset = $score->beatmap->beatmapset;
            $beatmapsetId = $beatmapset->getKey();

            if (rand(0, 1) === 0 && !$favouritedBeatmapsetIds->contains($beatmapsetId)) {
                FavouriteBeatmapset::create([
                    'beatmapset_id' => $beatmapsetId,
                    'user_id' => $userId,
                ]);
                $favouritedBeatmapsetIds->add($beatmapsetId);
            }

            BeatmapPlaycount::create([
                'user_id' => $userId,
                'beatmap_id' => $score->beatmap_id,
                'playcount' => rand(0, 1500),
            ]);

            if (rand(0, 4) === 0) {
                DB::table('osu_leaders')->where('beatmap_id', $score->beatmap_id)->delete();
                DB::insert('INSERT INTO osu_leaders (beatmap_id, score_id, user_id) VALUES (?, ?, ?)', [
                    $score->beatmap_id,
                    $score->getKey(),
                    $userId,
                ]);
            }
        }
    }
}
