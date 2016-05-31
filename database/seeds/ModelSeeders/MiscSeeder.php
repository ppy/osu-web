<?php

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

            //COUNTS
            if (!DB::table('osu_counts')->where('name', 'pp_rank_column')->get()) {
                DB::table('osu_counts')->insert([
                    'name' => 'pp_rank_column',
                    'count' => 90,
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
            ]);
            $any_genre = \App\Models\Genre::find(99);
            $any_genre->genre_id = 0;
            $any_genre->save();
            //  END GENRES

            //LANGUAGES
            DB::table('osu_languages')->insert([
                ['language_id' => 99, 'name' => 'Any', 'display_order' => 0],
                ['language_id' => 1, 'name' => 'Other', 'display_order' => 11],
                ['language_id' => 2, 'name' => 'English', 'display_order' => 1],
                ['language_id' => 3, 'name' => 'Japanese', 'display_order' => 6],
                ['language_id' => 4, 'name' => 'Chinese', 'display_order' => 2],
                ['language_id' => 5, 'name' => 'Instrumental', 'display_order' => 10],
                ['language_id' => 6, 'name' => 'Korean', 'display_order' => 7],
                ['language_id' => 7, 'name' => 'French', 'display_order' => 3],
                ['language_id' => 8, 'name' => 'German', 'display_order' => 4],
                ['language_id' => 9, 'name' => 'Swedish', 'display_order' => 9],
                ['language_id' => 10, 'name' => 'Spanish', 'display_order' => 8],
                ['language_id' => 11, 'name' => 'Italian', 'display_order' => 5],
            ]);
            $any_language = \App\Models\Language::find(99);
            $any_language->language_id = 0;
            $any_language->save();
            //END LANGUAGES
        } catch (\Illuminate\Database\QueryException $e) {
            echo $e->getMessage()."\r\n";
        } catch (Exception $ex) {
            echo $ex->getMessage()."\r\n";
        }
    }
}
