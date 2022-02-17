<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Forum\Authorize;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\User;
use App\Models\UserStatistics\Osu as StatisticsOsu;
use Tests\TestCase;

class ForumTopicsControllerTest extends TestCase
{
    public function testPin(): void
    {
        $moderator = User::factory()->withGroup('gmt')->create();
        $topic = Topic::factory()->create();
        $typeInt = Topic::TYPES['sticky'];

        $this
            ->actingAsVerified($moderator)
            ->post(route('forum.topics.pin', $topic), ['pin' => $typeInt])
            ->assertSuccessful();

        $this->assertSame($typeInt, $topic->fresh()->topic_type);
    }

    public function testReply(): void
    {
        $topic = Topic::factory()->create();
        $user = User::factory()->create();
        Authorize::factory()->reply()->create([
            'forum_id' => $topic->forum_id,
            'group_id' => app('groups')->byIdentifier('default'),
        ]);

        $initialPostCount = Post::count();
        $initialTopicCount = Topic::count();

        // fail because no plays =)
        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Post::count());
        $this->assertSame($initialTopicCount, Topic::count());

        // add some plays so it passes
        $this->addPlaycount($user);

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(200);

        $this->assertSame($initialPostCount + 1, Post::count());
        $this->assertSame($initialTopicCount, Topic::count());
    }

    public function testRestore(): void
    {
        $moderator = User::factory()->withGroup('gmt')->create();
        $topic = Topic::factory()->withPost()->create();
        $topic->delete();

        $this->expectCountChange(fn () => Topic::count(), 1);

        $this
            ->actingAsVerified($moderator)
            ->post(route('forum.topics.restore', $topic))
            ->assertSuccessful();
    }

    public function testShow(): void
    {
        $topic = Topic::factory()->withPost()->create();

        $this
            ->get(route('forum.topics.show', $topic))
            ->assertStatus(200);
    }

    public function testShowNoMorePosts(): void
    {
        $topic = Topic::factory()->withPost()->create();

        $this
            ->get(route('forum.topics.show', [
                'start' => $topic->topic_first_post_id + 1,
                'topic' => $topic,
            ]))
            ->assertStatus(302);
    }

    public function testShowNoMorePostsWithSkipLayout(): void
    {
        $topic = Topic::factory()->withPost()->create();

        $this
            ->get(route('forum.topics.show', [
                'skip_layout' => 1,
                'start' => $topic->topic_first_post_id + 1,
                'topic' => $topic,
            ]))
            ->assertStatus(204);
    }

    public function testShowMissingPosts(): void
    {
        $topic = Topic::factory()->create();

        $this
            ->get(route('forum.topics.show', $topic))
            ->assertStatus(404);
    }

    public function testShowNewUser(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $user = User::factory()->create();

        $this
            ->be($user)
            ->get(route('forum.topics.show', $topic))
            ->assertSuccessful();
    }

    public function testStore(): void
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();
        Authorize::factory()->post()->create([
            'forum_id' => $forum,
            'group_id' => app('groups')->byIdentifier('default'),
        ]);

        $initialPostCount = Post::count();
        $initialTopicCount = Topic::count();
        $initialTopicTrackCount = TopicTrack::count();

        // fail because no plays =)
        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Post::count());
        $this->assertSame($initialTopicCount, Topic::count());
        $this->assertSame($initialTopicTrackCount, TopicTrack::count());

        // add some plays so it passes
        $this->addPlaycount($user);

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertRedirect(route(
                'forum.topics.show',
                Topic::orderBy('topic_id', 'DESC')->first(),
            ));

        $this->assertSame($initialPostCount + 1, Post::count());
        $this->assertSame($initialTopicCount + 1, Topic::count());
        $this->assertSame($initialTopicTrackCount + 1, TopicTrack::count());
    }

    public function testUpdateTitle(): void
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->withPost()->create([
            'topic_poster' => $user->getKey(),
            'topic_title' => 'Initial title',
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

    public function testUpdateTitleBlank(): void
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->withPost()->create(['topic_poster' => $user->getKey()]);
        $title = $topic->topic_title;

        $this
            ->actingAsVerified($user)
            ->put(route('forum.topics.update', $topic), [
                'forum_topic' => [
                    'topic_title' => null,
                ],
            ])
            ->assertStatus(422);

        $this->assertSame($title, $topic->fresh()->topic_title);
    }

    private function addPlaycount(User $user, ?int $playcount = null): void
    {
        $playcount ??= config('osu.forum.minimum_plays');

        if ($user->statisticsOsu === null) {
            factory(StatisticsOsu::class)->create([
                'playcount' => $playcount,
                'user_id' => $user,
            ]);
        } else {
            $user->statisticsOsu->update(['playcount' => $playcount]);
        }

        $user->refresh();
    }
}
