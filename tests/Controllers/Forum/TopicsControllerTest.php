<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Forum;

use App\Exceptions\InvalidScopeException;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Log;
use App\Models\OAuth\Client;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TopicsControllerTest extends TestCase
{
    public static function dataProviderForAuthCodeDelegateOnlyGroupTests(): array
    {
        // $groups, $forumGroups, $success
        return [
            [[], []],
            [['loved'], []],
            [['loved'], ['loved']],
            [['loved'], ['gmt']],
            [['gmt'], []],
            [['gmt'], ['loved']],
            [['gmt'], ['gmt']],
        ];
    }

    public static function dataProviderForClientCredentialsGroupTests(): array
    {
        // $groups, $forumGroups, $expectException, $success
        return [
            [[], [], true, false],

            // standalone group
            [['bot'], [], false, false],
            [['loved'], [], true, false],
            [['loved'], ['loved'], true, false],
            [['loved'], ['gmt'], true, false],
            [['gmt'], [], true, false],
            [['gmt'], ['loved'], true, false],
            [['gmt'], ['gmt'], true, false],

            // with bot group, bot needs to be last for the factory.
            [['loved', 'bot'], [], false, false],
            [['loved', 'bot'], ['loved'], false, true],
            [['loved', 'bot'], ['gmt'], false, false],
            [['gmt', 'bot'], [], false, false],
            [['gmt', 'bot'], ['loved'], false, false],
            [['gmt', 'bot'], ['gmt'], false, true],
        ];
    }

    public static function dataProviderForModerationTests(): array
    {
        return [
            [null, [], false],
            ['gmt', [], true],
            ['loved', [], false],
            ['loved', ['loved'], true],
        ];
    }

    public static function dataProviderForTestDestroy(): array
    {
        return [
            [null, false],
            ['gmt', true],
        ];
    }

    public static function dataProviderForTestReply(): array
    {
        return [
            [false, 'reply', false],
            [true, 'reply', true],
            [true, 'post', false],
            [true, null, false],
        ];
    }

    public static function dataProviderForTestStore(): array
    {
        return [
            [false, 'post', false],
            [true, 'post', true],
            [true, 'reply', false],
            [true, null, false],
        ];
    }

    public static function dataProviderForTestUpdate(): array
    {
        return [
            [null, 'post', null, [], 422],
            ['new title', 'post', null, [], 204],
            ['new title', null, null, [], 403],
            ['new title', null, 'loved', [], 403],
            ['new title', null, 'loved', ['loved'], 204],
            ['new title', null, 'gmt', [], 204],
        ];
    }

    #[DataProvider('dataProviderForTestDestroy')]
    public function testDestroy(?string $group, bool $success): void
    {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()->withPost()->create();

        $this->expectCountChange(fn () => Topic::count(), $success ? -1 : 0);
        $this->expectCountChange(fn () => Log::count(), $success ? 1 : 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.topics.destroy', $topic))
            ->assertStatus($success ? 200 : 403);
    }

    public function testDestroyAsGuest(): void
    {
        $topic = Topic::factory()->withPost()->create();

        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => Log::count(), 0);

        $this
            ->delete(route('forum.topics.destroy', $topic))
            ->assertStatus(401);
    }

    public function testDestroyAsSameUser(): void
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->withPost()->create(['topic_poster' => $user]);

        $this->expectCountChange(fn () => Topic::count(), -1);
        $this->expectCountChange(fn () => Log::count(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.topics.destroy', $topic))
            ->assertRedirect(route('forum.forums.show', $topic->forum_id));
    }

    #[DataProvider('dataProviderForModerationTests')]
    public function testLock(?string $group, array $forumGroups, bool $success): void
    {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();

        $this->expectCountChange(fn () => Log::count(), $success ? 1 : 0);

        $response = $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.lock', $topic), ['lock' => true]);

        if ($success) {
            $response->assertSuccessful();
            $this->assertTrue($topic->fresh()->isLocked());
        } else {
            $response->assertStatus(403);
            $this->assertFalse($topic->fresh()->isLocked());
        }
    }

    #[DataProvider('dataProviderForAuthCodeDelegateOnlyGroupTests')]
    public function testLockAuthCode(array $groups, array $forumGroups): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create();
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();

        $this->expectInvalidScopeException('client_credentials_only');

        $this
            ->actAsScopedUser($user, ['forum.write_manage'], $client)
            ->post(route('api.forum.topics.lock', $topic), ['lock' => true]);
    }

    #[DataProvider('dataProviderForClientCredentialsGroupTests')]
    public function testLockClientCredentials(array $groups, array $forumGroups, bool $expectException, bool $success): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();

        if ($expectException) {
            $this->expectException(InvalidScopeException::class);
        }

        $response = $this
            ->actAsScopedUser(null, ['delegate', 'forum.write_manage'], $client)
            ->post(route('api.forum.topics.lock', $topic), ['lock' => true]);

        if ($success) {
            $response->assertSuccessful();
        } else {
            $response->assertStatus(403);
        }
    }

    #[DataProvider('dataProviderForModerationTests')]
    public function testPin(?string $group, array $forumGroups, bool $success): void
    {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();
        $typeInt = Topic::TYPES['sticky'];

        $this->expectCountChange(fn () => Log::count(), $success ? 1 : 0);

        $response = $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.pin', $topic), ['pin' => $typeInt]);

        if ($success) {
            $response->assertSuccessful();
            $this->assertSame($typeInt, $topic->fresh()->topic_type);
        } else {
            $response->assertStatus(403);
            $this->assertSame(Topic::TYPES['normal'], $topic->fresh()->topic_type);
        }
    }

    #[DataProvider('dataProviderForAuthCodeDelegateOnlyGroupTests')]
    public function testPinAuthCode(array $groups, array $forumGroups): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create();
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();

        $this->expectInvalidScopeException('client_credentials_only');

        $this
            ->actAsScopedUser($user, ['forum.write_manage'], $client)
            ->post(route('api.forum.topics.pin', $topic), ['pin' => Topic::TYPES['sticky']]);
    }

    #[DataProvider('dataProviderForClientCredentialsGroupTests')]
    public function testPinClientCredentials(array $groups, array $forumGroups, bool $expectException, bool $success): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();

        if ($expectException) {
            $this->expectException(InvalidScopeException::class);
        }

        $response = $this
            ->actAsScopedUser(null, ['delegate', 'forum.write_manage'], $client)
            ->post(route('api.forum.topics.pin', $topic), ['pin' => Topic::TYPES['sticky']]);

        if ($success) {
            $response->assertSuccessful();
        } else {
            $response->assertStatus(403);
        }
    }

    #[DataProvider('dataProviderForTestReply')]
    public function testReply(bool $hasMinPlays, ?string $authorize, bool $success): void
    {
        $topic = Topic::factory()->for(Forum::factory()->withAuthorize($authorize))->create();
        $user = User::factory()->withPlays($hasMinPlays ? $GLOBALS['cfg']['osu']['forum']['minimum_plays'] : 0)->create();

        $this->expectCountChange(fn () => Post::count(), $success ? 1 : 0);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), $success ? 1 : 0);

        $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.reply', $topic), [
                'body' => 'This is test reply',
            ])
            ->assertStatus($success ? 200 : 403);
    }

    public function testReplyAuthCode(): void
    {
        $topic = Topic::factory()->for(Forum::factory()->withAuthorize('reply'))->create();
        $user = User::factory()->withPlays($GLOBALS['cfg']['osu']['forum']['minimum_plays'])->create();
        $client = Client::factory()->create();

        $this->expectCountChange(fn () => Post::count(), 1);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 1);

        $this
            ->actAsScopedUser($user, ['forum.write'], $client)
            ->post(route('api.forum.topics.reply', $topic), [
                'body' => 'This is test reply',
            ])
            ->assertSuccessful();
    }

    #[DataProvider('dataProviderForClientCredentialsGroupTests')]
    public function testReplyClientCredentials(array $groups, array $forumGroups, bool $expectException, bool $success): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->create();

        if ($expectException) {
            $this->expectException(InvalidScopeException::class);
        }

        $countChange = $success ? 1 : 0;

        $this->expectCountChange(fn () => Post::count(), $countChange);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), $countChange);

        $response = $this
            ->actAsScopedUser(null, ['delegate', 'forum.write'], $client)
            ->post(route('api.forum.topics.reply', $topic), [
                'body' => 'This is test reply',
            ]);

        if ($success) {
            $response->assertSuccessful();
        } else {
            $response->assertStatus(403);
        }
    }

    #[DataProvider('dataProviderForModerationTests')]
    public function testRestore(?string $group, array $forumGroups, bool $success): void
    {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()->withPost()->for(Forum::factory()->moderatorGroups($forumGroups))->create();
        $topic->delete();

        $this->expectCountChange(fn () => Topic::count(), $success ? 1 : 0);
        $this->expectCountChange(fn () => Log::count(), $success ? 1 : 0);

        $response = $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.restore', $topic));

        if ($success) {
            $response->assertSuccessful();
        } else {
            $response->assertStatus(403);
        }
    }

    public function testShow(): void
    {
        $topic = Topic::factory()->withPost()->create();

        $this
            ->get(route('forum.topics.show', $topic))
            ->assertSuccessful();
    }

    public function testShowMissingFirstPost(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $topic->update(['topic_first_post_id' => 0]);

        $this
            ->get(route('forum.topics.show', $topic))
            ->assertStatus(404);
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

    #[DataProvider('dataProviderForTestStore')]
    public function testStore(bool $hasMinPlays, ?string $authorize, bool $success): void
    {
        $forum = Forum::factory()->withAuthorize($authorize)->create();
        $user = User::factory()->withPlays($hasMinPlays ? $GLOBALS['cfg']['osu']['forum']['minimum_plays'] : 0)->create();

        $change = $success ? 1 : 0;
        $this->expectCountChange(fn () => Post::count(), $change);
        $this->expectCountChange(fn () => Topic::count(), $change);
        $this->expectCountChange(fn () => TopicTrack::count(), $change);

        $response = $this
            ->actingAsVerified($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ]);

        if ($success) {
            $response->assertRedirect(route(
                'forum.topics.show',
                Topic::orderBy('topic_id', 'DESC')->first(),
            ));
        } else {
            $response->assertStatus(403);
        }
    }

    public function testStoreAuthCode(): void
    {
        $forum = Forum::factory()->withAuthorize('post')->create();
        $user = User::factory()->withPlays($GLOBALS['cfg']['osu']['forum']['minimum_plays'])->create();
        $client = Client::factory()->create();

        $this->expectCountChange(fn () => Post::count(), 1);
        $this->expectCountChange(fn () => Topic::count(), 1);
        $this->expectCountChange(fn () => TopicTrack::count(), 1);

        $this
            ->actAsScopedUser($user, ['forum.write'], $client)
            ->post(route('api.forum.topics.store', ['forum_id' => $forum]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertSuccessful();
    }

    #[DataProvider('dataProviderForClientCredentialsGroupTests')]
    public function testStoreClientCredentials(array $groups, array $forumGroups, bool $expectException, bool $success): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $forum = Forum::factory()->moderatorGroups($forumGroups)->create();

        if ($expectException) {
            $this->expectException(InvalidScopeException::class);
        }

        $countChange = $success ? 1 : 0;

        $this->expectCountChange(fn () => Post::count(), $countChange);
        $this->expectCountChange(fn () => Topic::count(), $countChange);
        $this->expectCountChange(fn () => TopicTrack::count(), $countChange);

        $response = $this
            ->actAsScopedUser(null, ['delegate', 'forum.write'], $client)
            ->post(route('api.forum.topics.store', ['forum_id' => $forum]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ]);

        if ($success) {
            $response->assertSuccessful();
        } else {
            $response->assertStatus(403);
        }
    }

    #[DataProvider('dataProviderForTestUpdate')]
    public function testUpdate(?string $newTitle, ?string $authorize, ?string $group, array $forumGroups, int $statusCode): void
    {
        $user = User::factory()->withGroup($group)->create();
        $topic = Topic::factory()->withPost()->for(
            Forum::factory()->withAuthorize($authorize)->moderatorGroups($forumGroups)
        )->create([
            'topic_poster' => $user,
            'topic_title' => 'Initial title',
        ]);

        $this
            ->actingAsVerified($user)
            ->put(route('forum.topics.update', $topic), [
                'forum_topic' => [
                    'topic_title' => $newTitle,
                ],
            ])
            ->assertStatus($statusCode);

        if ($statusCode === 204) {
            $this->assertSame($newTitle, $topic->fresh()->topic_title);
        } else {
            $this->assertSame('Initial title', $topic->fresh()->topic_title);
        }
    }

    public function testUpdateAuthCode(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $topic = Topic::factory()->for(Forum::factory()->withAuthorize('post'))->withPost()->create(['topic_poster' => $user]);

        $this->expectCountChange(fn () => Post::count(), 0);
        $this->expectCountChange(fn () => Topic::count(), 0);

        $this
            ->actAsScopedUser($user, ['forum.write'], $client)
            ->put(route('api.forum.topics.update', $topic), [
                'forum_topic' => [
                    'topic_title' => 'A different title',
                ],
            ])
            ->assertSuccessful();
    }

    #[DataProvider('dataProviderForClientCredentialsGroupTests')]
    public function testUpdateClientCredentials(array $groups, array $forumGroups, bool $expectException, bool $success): void
    {
        $user = User::factory()->withGroups($groups)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $topic = Topic::factory()->for(Forum::factory()->moderatorGroups($forumGroups))->withPost()->create(['topic_poster' => $user]);

        if ($expectException) {
            $this->expectException(InvalidScopeException::class);
        }

        $this->expectCountChange(fn () => Post::count(), 0);
        $this->expectCountChange(fn () => Topic::count(), 0);

        $response = $this
            ->actAsScopedUser(null, ['delegate', 'forum.write'], $client)
            ->put(route('api.forum.topics.update', $topic), [
                'forum_topic' => [
                    'topic_title' => 'A different title',
                ],
            ]);

        if ($success) {
            $response->assertSuccessful();
        } else {
            $response->assertStatus(403);
        }
    }
}
