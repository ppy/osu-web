<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Seeders\ModelSeeders;

use App\Models\Forum\Authorize;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        // Hardcoded forums
        Forum::factory()
            ->closed()
            ->has(
                Forum::factory()->state([
                    'forum_desc' => 'The place to go when you have a problem to report or a question to ask.',
                    'forum_id' => config('osu.forum.help_forum_id'),
                    'forum_name' => 'Help',
                ]),
                'subforums',
            )
            ->has(
                Forum::factory()->state([
                    'forum_desc' => 'Suggest what you would like to see in osu!.',
                    'forum_id' => config('osu.forum.feature_forum_id'),
                    'forum_name' => 'Feature Requests',
                ]),
                'subforums',
            )
            ->create([
                'forum_desc' => 'osu! specific',
                'forum_name' => 'osu!',
            ]);
        Forum::factory()
            ->closed()
            ->has(
                Forum::factory()->state([
                    'forum_desc' => '',
                    'forum_name' => 'Management',
                ]),
                'subforums',
            )
            ->has(
                Forum::factory()->state([
                    'forum_desc' => '',
                    'forum_id' => config('osu.user.user_page_forum_id'),
                    'forum_name' => 'User Pages',
                ]),
                'subforums',
            )
            ->create([
                'forum_desc' => '',
                'forum_id' => config('osu.forum.admin_forum_id'),
                'forum_name' => 'Management',
            ]);

        // Other forums
        Forum::factory()
            ->closed()
            ->has(Forum::factory()->count(3), 'subforums')
            ->create([
                'forum_desc' => 'Everything else',
                'forum_name' => 'Other',
            ]);

        // Topics and posts
        $forums = Forum::where('forum_type', 1)
            ->where('forum_id', '<>', config('osu.user.user_page_forum_id'))
            ->get();
        foreach ($forums as $forum) {
            Topic::factory()
                ->count(5)
                ->withPost()
                ->has(
                    Post::factory()->count(5)->state([
                        'poster_id' => fn () => User::inRandomOrder()->first() ?? User::factory(),
                    ]),
                    'posts',
                )
                ->create([
                    'forum_id' => $forum,
                    'topic_poster' => fn () => User::inRandomOrder()->first() ?? User::factory(),
                ]);
        }

        // Authorization
        $defaultGroupId = app('groups')->byIdentifier('default')->getKey();
        foreach (Forum::all() as $forum) {
            foreach (['post', 'postCount', 'reply'] as $optionState) {
                Authorize::factory()->$optionState()->create([
                    'forum_id' => $forum->getKey(),
                    'group_id' => $defaultGroupId,
                ]);
            }
        }

        // Caches
        Topic::all()->each(fn (Topic $topic) => $topic->refreshCache());
        Forum::all()->each(fn (Forum $forum) => $forum->refreshCache());
    }
}
