<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\Achievement;
use App\Models\Genre;
use App\Models\Language;
use DB;
use Exception;
use Illuminate\Database\Seeder;

class MiscSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            //DELETE TABLES
            DB::table('osu_genres')->delete();
            DB::table('osu_languages')->delete();
            DB::table('osu_countries')->delete();
            DB::table('osu_achievements')->delete();

            //COUNTS
            if (!DB::table('osu_counts')->where('name', 'pp_rank_column')->get()) {
                DB::table('osu_counts')->insert([
                    ['name' => 'pp_rank_column', 'count' => 90],
                    ['name' => 'usercount', 'count' => 500000],
                ]);
            }
            //END COUNTS

            //GENRES
            DB::table('osu_genres')->insert([
                ['genre_id' => 99, 'name' => 'Any'],
                ['genre_id' => 1, 'name' => 'Unspecified'],
                ['genre_id' => 2, 'name' => 'Video Game'],
                ['genre_id' => 3, 'name' => 'Anime'],
                ['genre_id' => 4, 'name' => 'Rock'],
                ['genre_id' => 5, 'name' => 'Pop'],
                ['genre_id' => 6, 'name' => 'Other'],
                ['genre_id' => 7, 'name' => 'Novelty'],
                // genre_id 8 doesnt exist
                ['genre_id' => 9, 'name' => 'Hip Hop'],
                ['genre_id' => 10, 'name' => 'Electronic'],
                ['genre_id' => 11, 'name' => 'Metal'],
                ['genre_id' => 12, 'name' => 'Classical'],
                ['genre_id' => 13, 'name' => 'Folk'],
                ['genre_id' => 14, 'name' => 'Jazz'],
            ]);
            $any_genre = Genre::find(99);
            $any_genre->genre_id = 0;
            $any_genre->save();
            //  END GENRES

            //LANGUAGES
            DB::table('osu_languages')->insert([
                ['language_id' => 99, 'name' => 'Any', 'display_order' => 0],
                ['language_id' => 1, 'name' => 'Unspecified', 'display_order' => 14],
                ['language_id' => 2, 'name' => 'English', 'display_order' => 1],
                ['language_id' => 3, 'name' => 'Japanese', 'display_order' => 6],
                ['language_id' => 4, 'name' => 'Chinese', 'display_order' => 2],
                ['language_id' => 5, 'name' => 'Instrumental', 'display_order' => 12],
                ['language_id' => 6, 'name' => 'Korean', 'display_order' => 7],
                ['language_id' => 7, 'name' => 'French', 'display_order' => 3],
                ['language_id' => 8, 'name' => 'German', 'display_order' => 4],
                ['language_id' => 9, 'name' => 'Swedish', 'display_order' => 9],
                ['language_id' => 10, 'name' => 'Spanish', 'display_order' => 8],
                ['language_id' => 11, 'name' => 'Italian', 'display_order' => 5],
                ['language_id' => 12, 'name' => 'Russian', 'display_order' => 10],
                ['language_id' => 13, 'name' => 'Polish', 'display_order' => 11],
                ['language_id' => 14, 'name' => 'Other', 'display_order' => 13],
            ]);
            $any_language = Language::find(99);
            $any_language->language_id = 0;
            $any_language->save();
            //END LANGUAGES

            //ACHIEVEMENTS
            $beatmapSlugs = ['all-packs-anime-1', 'all-packs-anime-2', 'all-packs-gamer-1', 'all-packs-gamer-2', 'all-packs-rhythm-1', 'all-packs-rhythm-2'];
            Achievement::factory()->count(5)->create([
                'grouping' => 'Beatmap Packs',
                'slug' => array_rand_val($beatmapSlugs),
            ]);
            $comboSlugs = ['osu-combo-500', 'osu-combo-750', 'osu-combo-1000', 'osu-combo-2000'];
            Achievement::factory()->count(5)->create([
                'grouping' => 'Combo',
                'slug' => array_rand_val($comboSlugs),
            ]);
            //END ACHIEVEMENTS
        } catch (Exception $ex) {
            echo $ex->getMessage().PHP_EOL;
        }
    }
}
