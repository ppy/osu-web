<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

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
            // Create appropriate forum permissions
            $authOptionIds = [];

            foreach (['f_post', 'f_reply'] as $authOption) {
                $option = new App\Models\Forum\AuthOption;
                $option->auth_option = $authOption;
                $option->save();

                $authOptionIds[] = $option->auth_option_id;
            }

            $beatmapCount = App\Models\Beatmapset::count();
            if ($beatmapCount > 0) {
                // Create beatmap threads
                $f = factory(App\Models\Forum\Forum::class, 'parent')->create([
                    'forum_name' => 'Beatmap Threads',
                    'forum_desc' => 'Beatmap thread info for beatmaps',
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
                        'topic_poster' => $set->user_id,
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

            // Create userpage threads
            $f = factory(App\Models\Forum\Forum::class, 'parent')->create([
                'forum_name' => 'User Pages',
                'forum_desc' => 'Your user profile pages go here!',
            ]);

            $f->subforums()->save(factory(App\Models\Forum\Forum::class, 'child')->make([
                'forum_id' => config('osu.user.user_page_forum_id'),
                'parent_id' => $f->forum_id,
                'forum_name' => 'User Pages',
            ]));

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

            foreach (App\Models\Forum\Forum::all() as $forum) {
                foreach ($authOptionIds as $optionId) {
                    $group = new App\Models\Forum\Authorize;

                    $group->group_id = App\Models\UserGroup::GROUPS['default'];
                    $group->forum_id = $forum->forum_id;
                    $group->auth_option_id = $optionId;
                    $group->auth_setting = 1;

                    $group->save();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            echo $e->getMessage()."\r\n";
        } catch (Exception $ex) {
            echo $ex->getMessage()."\r\n";
        }
    }
}
