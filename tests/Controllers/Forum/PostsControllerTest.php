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
        // $first, $newText, $group, $forumGroups, $authorize, $aclGroup, $statusCode
        return [
            // default acl post
            [true, null, null, [], 'post', null, 422],
            [true, null, null, [], 'reply', null, 403],
            [true, 'new text', null, [], 'post', null, 200],
            [true, 'new text', null, [], 'reply', null, 403],
            [true, 'new text', null, [], null, null, 403],
            [true, 'new text', 'loved', [], null, null, 403],
            [true, 'new text', 'loved', ['loved'], null, null, 200],
            [true, 'new text', 'gmt', [], null, null, 200],

            // default acl reply
            [false, null, null, [], 'post', null, 403],
            [false, null, null, [], 'reply', null, 422],
            [false, 'new text', null, [], 'post', null, 403],
            [false, 'new text', null, [], 'reply', null, 200],
            [false, 'new text', null, [], null, null, 403],
            [false, 'new text', 'loved', [], null, null, 403],
            [false, 'new text', 'loved', ['loved'], null, null, 200],
            [false, 'new text', 'gmt', [], null, null, 200],

            // specific group acl post
            [true, 'new text', null, [], 'post', 'gmt', 403],
            [true, 'new text', 'loved', [], 'post', 'loved', 200],
            [true, 'new text', 'loved', [], 'post', 'gmt', 403],
            [true, 'new text', null, [], 'reply', 'gmt', 403],
            [true, 'new text', 'loved', [], 'reply', 'loved', 403],
            [true, 'new text', 'loved', [], 'reply', 'gmt', 403],

            // specific group acl reply
            [false, 'new text', null, [], 'post', 'gmt', 403],
            [false, 'new text', 'loved', [], 'post', 'loved', 403],
            [false, 'new text', 'loved', [], 'post', 'gmt', 403],
            [false, 'new text', null, [], 'reply', 'gmt', 403],
            [false, 'new text', 'loved', [], 'reply', 'loved', 200],
            [false, 'new text', 'loved', [], 'reply', 'gmt', 403],
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
    public function testUpdate(
        bool $first,
        ?string $newText,
        ?string $group,
        array $forumGroups,
        ?string $authorize,
        ?string $aclGroup,
        int $statusCode
    ): void {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()
            ->for(Forum::factory()->withAuthorize($authorize, $aclGroup)->moderatorGroups($forumGroups))
            ->withPost(['post_text' => 'text'])
            ->create([
                'topic_poster' => $user,
            ]);
        $post = $first ? $topic->firstPost : Post::factory()->create([
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
