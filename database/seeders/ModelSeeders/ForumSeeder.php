<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\Beatmapset;
use App\Models\Forum;
use App\Models\User;
use Exception;
use Faker\Factory as Faker;
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
        $faker = Faker::create();

        try {
            // Create appropriate forum permissions
            $authOptionIds = [];

            foreach (['f_post', 'f_postcount', 'f_read', 'f_reply'] as $authOption) {
                $option = new Forum\AuthOption();
                $option->auth_option = $authOption;
                $option->save();

                $authOptionIds[] = $option->auth_option_id;
            }

            $beatmapCount = Beatmapset::count();
            if ($beatmapCount > 0) {
                // Create beatmap threads
                $f = factory(Forum\Forum::class)->states('parent')->create([
                    'forum_name' => 'Beatmap Threads',
                    'forum_desc' => 'Beatmap thread info for beatmaps',
                ]);

                $f2 = $f->subforums()->save(factory(Forum\Forum::class)->states('child')->make([
                    'parent_id' => 1,
                    'forum_name' => 'Beatmap Threads',
                    'forum_desc' => 'Beatmap thread info for beatmaps',
                ]));

                $bms = Beatmapset::all();
                foreach ($bms as $set) {
                    $user = User::find($set->user_id);
                    $t = $f2->topics()->save(factory(Forum\Topic::class)->make([
                        'forum_id' => $f2->forum_id,
                        'topic_first_poster_name' => $user->username,
                        'topic_poster' => $user->getKey(),
                        'topic_title' => $set->artist.' - '.$set->title,
                    ]));

                    $p = $t->posts()->save(factory(Forum\Post::class)->make([
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
            $f = factory(Forum\Forum::class)->states('parent')->create([
                'forum_name' => 'User Pages',
                'forum_desc' => 'Your user profile pages go here!',
            ]);

            $f->subforums()->save(factory(Forum\Forum::class)->states('child')->make([
                'forum_id' => config('osu.user.user_page_forum_id'),
                'parent_id' => $f->forum_id,
                'forum_name' => 'User Pages',
            ]));

            // Create 3 forums
            factory(Forum\Forum::class, 3)->states('parent')->create()->each(function ($f) {
                for ($i = 0; $i < 4; $i++) {
                    // Subforums for each forum.
                    $f2 = $f->subforums()->save(factory(Forum\Forum::class)->states('child')->make());
                    // Topics for each subforum
                    for ($j = 0; $j < 3; $j++) {
                        $topicUser = User::orderByRaw('RAND()')->first();
                        $t = $f2->topics()->save(factory(Forum\Topic::class)->make([
                            'forum_id' => $f2->forum_id,
                            'topic_first_poster_name' => $topicUser->username,
                            'topic_poster' => $topicUser->getKey(),
                        ]));
                        // Replies to the topic
                        for ($k = 0; $k < 5; $k++) {
                            $postUser = User::orderByRaw('RAND()')->first();
                            $p = $t->posts()->save(factory(Forum\Post::class)->make([
                                'forum_id' => $f2->forum_id,
                                'post_username' => $postUser->username,
                                'poster_id' => $postUser->getKey(),
                            ]));
                        }
                        // Refresh topic cache (updates last post times etc)
                        $t->refreshCache();
                    }
                    // Refresh forum cache
                    $f2->refreshCache();
                }
            });

            foreach (Forum\Forum::all() as $forum) {
                foreach ($authOptionIds as $optionId) {
                    $group = new Forum\Authorize();

                    $group->group_id = app('groups')->byIdentifier('default')->getKey();
                    $group->forum_id = $forum->forum_id;
                    $group->auth_option_id = $optionId;
                    $group->auth_setting = 1;

                    $group->save();
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage().PHP_EOL;
        }
    }
}
