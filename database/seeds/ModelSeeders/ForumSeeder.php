<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        try {
            // DB::table('phpbb_forums')->delete();
            // DB::table('phpbb_topics')->delete();
            // DB::table('phpbb_posts')->delete();

            $forums = [];

            $beatmapCount = App\Models\Beatmapset::count();
            if ($beatmapCount > 0) {
                // Create beatmap threads
                $f = App\Models\Forum\Forum::create([
                    'forum_name' => 'Beatmap Threads',
                    'forum_desc' => 'Beatmap thread info for beatmaps',
                    'forum_type' => 0,
                ]);

                $f2 = $f->subforums()->save(factory(App\Models\Forum\Forum::class, 'child')->make([
                    'parent_id' => 1,
                    'forum_name' => 'Beatmap Threads',
                    'forum_desc' => 'Beatmap thread info for beatmaps',
                ]));

                $bms = App\Models\Beatmapset::all();
                foreach ($bms as $set) {
                    $t = $f2->topics()->save(factory(App\Models\Forum\Topic::class)->make([
                        'forum_id' => $f2->forum_id,
                        'topic_poster' => $set->creator,
                        'topic_title' => $set->artist.' - '.$set->title,
                    ]));

                    $p = $t->posts()->save(factory(App\Models\Forum\Post::class)->make([
                        'forum_id' => $f2->forum_id,
                        'poster_id' => $set->user_id,
                        'post_username' => $set->creator,
                        'post_subject' => $set->artist.' - '.$set->title,
                        'post_text' => '---------------',
                    ]));

                    $t->refreshCache();
                    $set->thread_id = $t->topic_id;
                    $set->save();
                }
                $f2->refreshCache();
            }

            // Create 3 forums
            factory(App\Models\Forum\Forum::class, 'parent', 3)->create()->each(function ($f) {
                for ($i = 0; $i < 4; $i++) {
                    // Subforums for each forum.
                    $f2 = $f->subforums()->save(factory(App\Models\Forum\Forum::class, 'child')->make());
                    // Topics for each subforum
                    for ($j = 0; $j < 3; $j++) {
                        $t = $f2->topics()->save(factory(App\Models\Forum\Topic::class)->make(['forum_id' => $f2->forum_id]));
                        // Replies to the topic
                        for ($k = 0; $k < 5; $k++) {
                            $p = $t->posts()->save(factory(App\Models\Forum\Post::class)->make(['forum_id' => $f2->forum_id]));
                        }
                        // Refresh topic cache (updates last post times etc)
                        $t->refreshCache();
                    }
                    // Refresh forum cache
                    $f2->refreshCache();
                }
            });
        } catch (\Illuminate\Database\QueryException $e) {
            echo $e->getMessage()."\r\n";
        } catch (Exception $ex) {
            echo $ex->getMessage()."\r\n";
        }
    }
}
