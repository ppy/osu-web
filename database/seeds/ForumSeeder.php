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
            DB::table('phpbb_forums')->delete();
            DB::table('phpbb_topics')->delete();
            DB::table('phpbb_posts')->delete();

            $forums = [];

        // Create 3 forums
        factory(App\Models\Forum\Forum::class, 'parent', 3)->create()->each(function ($f) {
          for ($i = 0; $i < 4; $i++) {
              // Subforums for each forum.
              $f2 = $f->subforums()->save(factory(App\Models\Forum\Forum::class, 'child')->make());
              // Topics for each subforum
              for ($j = 0; $j < 3; $j++) {
                  $t = $f2->topics()->save(factory(App\Models\Forum\Topic::class)->make());
                // Replies to the topic
                for ($k = 0; $k < 5; $k++) {
                    $p = $t->posts()->save(factory(App\Models\Forum\Post::class)->make());
                }
                // Refresh topic cache (updates last post times etc)
                $t->refreshCache();
                // Update user forum cache (this doesn't appear to be necessary)
                // App\Models\User::find($p->poster_id)->refreshForumCache($f2, 1);
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
