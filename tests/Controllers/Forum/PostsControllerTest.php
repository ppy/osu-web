<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Forum;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
    public static function dataProviderForTestUpdate(): array
    {
        return [
            [null, 'post', null, [], 422],
            ['new text', 'post', null, [], 200],
            ['new text', null, null, [], 403],
            ['new text', null, 'loved', [], 403],
            ['new text', null, 'loved', ['loved'], 200],
            ['new text', null, 'gmt', [], 200],
        ];
    }

    public function testDestroy(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);

        $this->expectCountChange(fn () => Post::count(), -1);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), -1);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertSuccessful();
    }

    public function testDestroyFirstPost(): void
    {
        $topic = Topic::factory()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);

        $this->expectCountChange(fn () => Post::count(), 0);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(422);
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

        $this->expectCountChange(fn () => Post::count(), 0);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(403);
    }

    public function testRestore(): void
    {
        $moderator = User::factory()->withGroup('gmt')->create();
        $topic = Topic::factory()->withPost()->create();
        $post = Post::factory()->create(['topic_id' => $topic]);
        $post->delete();

        $this->expectCountChange(fn () => Post::count(), 1);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 1);

        $this
            ->actingAsVerified($moderator)
            ->post(route('forum.posts.restore', $post))
            ->assertSuccessful();
    }

    #[DataProvider('dataProviderForTestUpdate')]
    public function testUpdate(?string $newText, ?string $authorize, ?string $group, array $forumGroups, int $statusCode): void
    {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()->withPost()->for(
            Forum::factory()->withAuthorize($authorize)->moderatorGroups($forumGroups)
        )->create([
            'topic_poster' => $user,
        ]);
        $post = Post::factory()->create([
            'topic_id' => $topic,
            'post_text' => 'text',
            'poster_id' => $user,
        ]);

        $this
            ->actingAsVerified($user)
            ->put(route('forum.posts.update', $post), [
                'body' => $newText,
            ])
            ->assertStatus($statusCode);

        if ($statusCode === 200) {
            $this->assertSame($newText, $post->fresh()->post_text);
        } else {
            $this->assertSame('text', $post->fresh()->post_text);
        }
    }
}
