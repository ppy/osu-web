<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Tests\TestCase;

class ForumPostsControllerTest extends TestCase
{
    public function testDestroy(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);

        $initialPostCount = Post::count();
        $initialTopicCount = Topic::count();

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertSuccessful();

        $topic->refresh();

        $this->assertSame($initialPostCount - 1, Post::count());
        $this->assertSame($initialTopicCount, Topic::count());
        $this->assertSame(1, $topic->postCount());
    }

    public function testDestroyFirstPost(): void
    {
        $topic = Topic::factory()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);

        $initialPostCount = Post::count();
        $initialTopicCount = Topic::count();

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(422);

        $topic->refresh();

        $this->assertSame($initialPostCount, Post::count());
        $this->assertSame($initialTopicCount, Topic::count());
        $this->assertSame(1, $topic->postCount());
    }

    public function testDestroyNotLastPost(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);
        Post::factory()->create(['topic_id' => $topic]);

        $initialPostCount = Post::count();
        $initialTopicCount = Topic::count();

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(403);

        $topic->refresh();

        $this->assertSame($initialPostCount, Post::count());
        $this->assertSame($initialTopicCount, Topic::count());
        $this->assertSame(3, $topic->postCount());
    }

    public function testRestore(): void
    {
        $moderator = User::factory()->withGroup('gmt')->create();
        $topic = Topic::factory()->withPost()->create();
        $post = Post::factory()->create(['topic_id' => $topic]);
        $post->delete();

        $initialPostCount = Post::count();

        $this
            ->actingAsVerified($moderator)
            ->post(route('forum.posts.restore', $post))
            ->assertSuccessful();

        $topic->refresh();

        $this->assertSame($initialPostCount + 1, Post::count());
        $this->assertSame(2, $topic->postCount());
    }
}
