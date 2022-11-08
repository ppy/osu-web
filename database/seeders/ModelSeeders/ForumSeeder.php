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

        // Users
        $userCount = User::count();
        if ($userCount < 10) {
            User::factory()->count(10 - $userCount)->create();
        }

        // Forums to be populated, i.e. all open forums except "User Pages"
        $forums = Forum::where('forum_type', 1)
            ->where('forum_id', '<>', config('osu.user.user_page_forum_id'))
            ->get();

        // Topics and posts
        foreach ($forums as $forum) {
            Topic::factory()
                ->count(5)
                ->withPost()
                ->has(
                    Post::factory()->count(5)->state([
                        'poster_id' => fn () => User::inRandomOrder()->firstOrFail(),
                    ]),
                    'posts',
                )
                ->create([
                    'forum_id' => $forum,
                    'topic_poster' => fn () => User::inRandomOrder()->firstOrFail(),
                ]);
        }

        // Authorization
        $defaultGroup = app('groups')->byIdentifier('default');
        foreach ($forums as $forum) {
            foreach (['post', 'postCount', 'reply'] as $optionState) {
                Authorize::factory()->$optionState()->create([
                    'forum_id' => $forum,
                    'group_id' => $defaultGroup,
                ]);
            }
        }

        // Caches
        Topic::all()->each(fn (Topic $topic) => $topic->refreshCache());
        Forum::all()->each(fn (Forum $forum) => $forum->refreshCache());
    }
}
