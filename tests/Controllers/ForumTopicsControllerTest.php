<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Forum;
use App\Models\User;
use App\Models\UserStatistics\Osu as StatisticsOsu;
use Tests\TestCase;

class ForumTopicsControllerTest extends TestCase
{
    public function testDestroy()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $user = factory(User::class)->create()->fresh();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        $authOption = Forum\AuthOption::firstOrCreate([
            'auth_option' => 'f_reply',
        ]);
        Forum\Authorize::create([
            'group_id' => $group->group_id,
            'forum_id' => $forum->forum_id,
            'auth_option_id' => $authOption->auth_option_id,
            'auth_setting' => 1,
        ]);

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        // fail because no plays =)
        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());

        // add some plays so it passes
        $this->addPlaycount($user);

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(200);

        $this->assertSame($initialPostCount + 1, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
    }

    public function testReply()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $user = factory(User::class)->create()->fresh();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        $authOption = Forum\AuthOption::firstOrCreate([
            'auth_option' => 'f_reply',
        ]);
        Forum\Authorize::create([
            'group_id' => $group->group_id,
            'forum_id' => $forum->forum_id,
            'auth_option_id' => $authOption->auth_option_id,
            'auth_setting' => 1,
        ]);

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        // fail because no plays =)
        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());

        // add some plays so it passes
        $this->addPlaycount($user);

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(200);

        $this->assertSame($initialPostCount + 1, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
    }

    public function testRestore()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $poster = factory(User::class)->create()->fresh();
        $poster->setDefaultGroup(app('groups')->byIdentifier('default'));
        Forum\Post::createNew($topic, $poster, 'test', false);

        $topic->refresh();
        $topic->delete();

        $user = factory(User::class)->create()->fresh();
        $user->setDefaultGroup(app('groups')->byIdentifier('gmt'));

        $initialTopicCount = Forum\Topic::count();

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.restore', $topic))
            ->assertSuccessful();

        $topic->refresh();

        $this->assertSame($initialTopicCount + 1, Forum\Topic::count());
    }

    public function testShow()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $post = factory(Forum\Post::class)->create([
            'forum_id' => $forum->forum_id,
            'topic_id' => $topic->topic_id,
        ]);

        $this
            ->get(route('forum.topics.show', $topic->topic_id))
            ->assertStatus(200);
    }

    public function testShowNoMorePosts()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $post = factory(Forum\Post::class)->create([
            'forum_id' => $forum->forum_id,
            'topic_id' => $topic->topic_id,
        ]);

        $this
            ->get(route('forum.topics.show', [
                'start' => $post->getKey() + 1,
                'topic' => $topic->getKey(),
            ]))->assertStatus(302);
    }

    public function testShowNoMorePostsWithSkipLayout()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $post = factory(Forum\Post::class)->create([
            'forum_id' => $forum->forum_id,
            'topic_id' => $topic->topic_id,
        ]);

        $this
            ->get(route('forum.topics.show', [
                'skip_layout' => 1,
                'start' => $post->getKey() + 1,
                'topic' => $topic->getKey(),
            ]))->assertStatus(204);
    }

    public function testShowMissingPosts()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);

        $this
            ->get(route('forum.topics.show', $topic->topic_id))
            ->assertStatus(404);
    }

    public function testShowNewUser()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $post = factory(Forum\Post::class)->create([
            'forum_id' => $forum->forum_id,
            'topic_id' => $topic->topic_id,
        ]);
        $user = factory(User::class)->create();

        $this
            ->be($user)
            ->get(route('forum.topics.show', $topic->topic_id))
            ->assertSuccessful();
    }

    public function testStore()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $user = factory(User::class)->create()->fresh();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        $authOption = Forum\AuthOption::firstOrCreate([
            'auth_option' => 'f_post',
        ]);
        Forum\Authorize::create([
            'group_id' => $group->getKey(),
            'forum_id' => $forum->forum_id,
            'auth_option_id' => $authOption->auth_option_id,
            'auth_setting' => 1,
        ]);

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();
        $initialTopicTrackCount = Forum\TopicTrack::count();

        // fail because no plays =)
        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum->forum_id]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
        $this->assertSame($initialTopicTrackCount, Forum\TopicTrack::count());

        // add some plays so it passes
        $this->addPlaycount($user);

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum->forum_id]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertRedirect(route(
                'forum.topics.show',
                Forum\Topic::orderBy('topic_id', 'DESC')->first()->topic_id
            ));

        $this->assertSame($initialPostCount + 1, Forum\Post::count());
        $this->assertSame($initialTopicCount + 1, Forum\Topic::count());
        $this->assertSame($initialTopicTrackCount + 1, Forum\TopicTrack::count());
    }

    public function testUpdateTitle()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        $initialTitle = 'New topic';
        $topic = Forum\Topic::createNew($forum, [
            'title' => $initialTitle,
            'user' => $user,
            'body' => 'This is a new topic',
        ]);

        $newTitle = 'A different title';

        $this
            ->actingAsVerified($user)
            ->put(route('forum.topics.update', $topic), [
                'forum_topic' => [
                    'topic_title' => $newTitle,
                ],
            ])
            ->assertSuccessful();

        $this->assertSame($newTitle, $topic->fresh()->topic_title);
    }

    public function testUpdateTitleBlank()
    {
        $forum = factory(Forum\Forum::class, 'child')->create();
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('default');
        $user->setDefaultGroup($group);
        $initialTitle = 'New topic';
        $topic = Forum\Topic::createNew($forum, [
            'title' => $initialTitle,
            'user' => $user,
            'body' => 'This is a new topic',
        ]);

        $this
            ->actingAsVerified($user)
            ->put(route('forum.topics.update', $topic), [
                'forum_topic' => [
                    'topic_title' => null,
                ],
            ])
            ->assertStatus(422);

        $this->assertSame($initialTitle, $topic->fresh()->topic_title);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // initial user for forum posts and stuff
        // FIXME: this is actually a hidden dependency
        factory(User::class)->create();
    }

    private function addPlaycount($user, $playcount = null)
    {
        $playcount ?? $playcount = config('osu.forum.minimum_plays');

        if ($user->statisticsOsu === null) {
            factory(StatisticsOsu::class)->create([
                'playcount' => $playcount,
                'user_id' => $user->getKey(),
            ]);
        } else {
            $user->statisticsOsu->update(['playcount' => $playcount]);
        }

        $user->refresh();
    }
}
