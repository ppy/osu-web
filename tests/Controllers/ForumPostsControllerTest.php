<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Forum;
use App\Models\User;
use Tests\TestCase;

class ForumPostsControllerTest extends TestCase
{
    public function testDestroy()
    {
        $forum = factory(Forum\Forum::class)->states('child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $user = User::factory()->create()->fresh();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        Forum\Post::createNew($topic, $user, 'test', false);
        $post = Forum\Post::createNew($topic, $user, 'a reply');

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertSuccessful();

        $topic->refresh();

        $this->assertSame($initialPostCount - 1, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
        $this->assertSame(1, $topic->postCount());
    }

    public function testDestroyFirstPost()
    {
        $forum = factory(Forum\Forum::class)->states('child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $user = User::factory()->create()->fresh();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        $post = Forum\Post::createNew($topic, $user, 'test', false);

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(422);

        $topic->refresh();

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
        $this->assertSame(1, $topic->postCount());
    }

    public function testDestroyNotLastPost()
    {
        $forum = factory(Forum\Forum::class)->states('child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $user = User::factory()->create()->fresh();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        Forum\Post::createNew($topic, $user, 'test', false);
        $post = Forum\Post::createNew($topic, $user, 'a reply');
        Forum\Post::createNew($topic, $user, 'another reply');

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(403);

        $topic->refresh();

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
        $this->assertSame(3, $topic->postCount());
    }

    public function testRestore()
    {
        $forum = factory(Forum\Forum::class)->states('child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $poster = User::factory()->create()->fresh();
        $poster->setDefaultGroup(app('groups')->byIdentifier('default'));
        Forum\Post::createNew($topic, $poster, 'test', false);
        $post = Forum\Post::createNew($topic, $poster, 'a reply');
        $post->delete();

        $user = User::factory()->create()->fresh();
        $user->setDefaultGroup(app('groups')->byIdentifier('gmt'));

        $initialPostCount = Forum\Post::count();

        $this
            ->actingAsVerified($user)
            ->post(route('forum.posts.restore', $post))
            ->assertSuccessful();

        $topic->refresh();

        $this->assertSame($initialPostCount + 1, Forum\Post::count());
        $this->assertSame(2, $topic->postCount());
    }
}
