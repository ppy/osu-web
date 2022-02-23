<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmapset;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserRelation;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{
    private $user;
    private $minPlays;
    private $beatmapset;
    private $params;

    /**
     * @dataProvider pinPermissionsDataProvider
     */
    public function testPin(?string $groupIdentifier, bool $onBeatmapset, bool $asBeatmapsetOwner, bool $asCommentOwner, bool $withPinned, bool $expectAllowed): void
    {
        $user = User::factory()->withGroup($groupIdentifier)->create();
        $comment = Comment::factory()->create([
            'commentable_type' => $onBeatmapset ? 'beatmapset' : 'build',
            'user_id' => $asCommentOwner ? $user->getKey() : User::factory(),
        ]);

        if ($asBeatmapsetOwner) {
            $comment->commentable->update(['user_id' => $user->getKey()]);
        }

        if ($withPinned) {
            $comment->commentable->comments()->save(Comment::factory()->make(['pinned' => true]));
        }

        $this
            ->actingAsVerified($user)
            ->post(route('comments.pin', $comment->getKey()))
            ->assertStatus($expectAllowed ? 200 : 403);

        $this->assertSame($comment->fresh()->pinned, $expectAllowed);
    }

    public function testPinReply(): void
    {
        $comment = Comment::factory()->reply()->create();
        $user = User::factory()->withGroup('admin')->create();

        $this
            ->actingAsVerified($user)
            ->post(route('comments.pin', $comment->getKey()))
            ->assertStatus(422);

        $this->assertFalse($comment->fresh()->pinned);
    }

    public function testStore()
    {
        $this->prepareForStore();
        $otherUser = User::factory()->create();

        $follow = Follow::create([
            'notifiable' => $this->beatmapset,
            'user' => $otherUser,
            'subtype' => 'comment',
        ]);

        $previousComments = Comment::count();
        $previousNotifications = Notification::count();

        $this
            ->be($this->user)
            ->post(route('comments.store'), $this->params)
            ->assertSuccessful();

        $this->assertSame($previousComments + 1, Comment::count());
        $this->assertSame($previousNotifications + 1, Notification::count());
    }

    public function testStoreNotEnoughPlays()
    {
        $this->prepareForStore();
        $this->user->statisticsOsu()->update(['playcount' => $this->minPlays - 1]);
        $previousComments = Comment::count();

        $this
            ->be($this->user)
            ->post(route('comments.store'), $this->params)
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $this->assertSame($previousComments, Comment::count());
    }

    public function testStoreNotEnoughPlaysVerified()
    {
        $this->prepareForStore();
        $this->user->statisticsOsu()->update(['playcount' => $this->minPlays - 1]);
        $previousComments = Comment::count();

        $this
            ->actingAsVerified($this->user)
            ->post(route('comments.store'), $this->params)
            ->assertStatus(200);

        $this->assertSame($previousComments + 1, Comment::count());
    }

    public function testStoreGuest()
    {
        $this->prepareForStore();
        $previousComments = Comment::count();

        $this
            ->post(route('comments.store'), $this->params)
            ->assertStatus(401);

        $this->assertSame($previousComments, Comment::count());
    }

    public function testStoreReply()
    {
        $this->prepareForStore();
        $parent = $this->beatmapset->comments()->create([
            'user_id' => $this->user->getKey(),
            'message' => 'Hello.',
        ]);

        $params = ['comment' => [
            'parent_id' => $parent->getKey(),
            'message' => 'This is a reply.',
        ]];

        $previousComments = $this->beatmapset->comments()->count();

        $this
            ->actingAsVerified($this->user)
            ->post(route('comments.store'), $params)
            ->assertStatus(200);

        $this->assertSame($previousComments + 1, $this->beatmapset->comments()->count());
    }

    public function testApiUnauthenticatedUserCanViewIndex()
    {
        $this
            ->json('GET', route('api.comments.index'))
            ->assertSuccessful();
    }

    public function testApiUnauthenticatedUserCanViewComment()
    {
        $comment = Comment::factory()->create();

        $this
            ->json('GET', route('api.comments.show', ['comment' => $comment->getKey()]))
            ->assertSuccessful();
    }

    /**
     * @dataProvider apiRequiresAuthenticationDataProvider
     */
    public function testApiRequiresAuthentication($method, $routeName)
    {
        $this
            ->json($method, route("api.{$routeName}", ['comment' => 1]))
            ->assertUnauthorized();
    }

    public function apiRequiresAuthenticationDataProvider()
    {
        return [
            ['DELETE', 'comments.vote'],
            ['POST', 'comments.vote'],
            ['POST', 'comments.store'],
            ['PUT', 'comments.update'],
            ['DELETE', 'comments.destroy'],
        ];
    }

    /**
     * Data in order:
     * - User's group identifier
     * - Whether the commentable is a beatmapset
     * - Whether the user is the beatmapset's creator
     * - Whether the user is the comment's creator
     * - Whether the commentable already has a pinned comment
     * - Whether pinning should be allowed
     */
    public function pinPermissionsDataProvider(): array
    {
        return [
            ['admin', true,  true,  true,  true,  true],
            ['admin', true,  true,  true,  false, true],
            ['admin', true,  true,  false, true,  true],
            ['admin', true,  true,  false, false, true],
            ['admin', true,  false, true,  true,  true],
            ['admin', true,  false, true,  false, true],
            ['admin', true,  false, false, true,  true],
            ['admin', true,  false, false, false, true],
            ['admin', false, false, true,  true,  true],
            ['admin', false, false, true,  false, true],
            ['admin', false, false, false, true,  true],
            ['admin', false, false, false, false, true],
            ['gmt',   true,  true,  true,  true,  false],
            ['gmt',   true,  true,  true,  false, true],
            ['gmt',   true,  true,  false, true,  false],
            ['gmt',   true,  true,  false, false, true],
            ['gmt',   true,  false, true,  true,  false],
            ['gmt',   true,  false, true,  false, true],
            ['gmt',   true,  false, false, true,  false],
            ['gmt',   true,  false, false, false, true],
            ['gmt',   false, false, true,  true,  false],
            ['gmt',   false, false, true,  false, false],
            ['gmt',   false, false, false, true,  false],
            ['gmt',   false, false, false, false, false],
            [null,    true,  true,  true,  true,  false],
            [null,    true,  true,  true,  false, true],
            [null,    true,  true,  false, true,  false],
            [null,    true,  true,  false, false, false],
            [null,    true,  false, true,  true,  false],
            [null,    true,  false, true,  false, false],
            [null,    true,  false, false, true,  false],
            [null,    true,  false, false, false, false],
            [null,    false, false, true,  true,  false],
            [null,    false, false, true,  false, false],
            [null,    false, false, false, true,  false],
            [null,    false, false, false, false, false],
        ];
    }

    private function prepareForStore()
    {
        config()->set('osu.user.post_action_verification', false);
        $this->minPlays = config('osu.user.min_plays_for_posting');

        $this->user = User::factory()->withPlays()->create();

        $this->beatmapset = Beatmapset::factory()->create();

        $this->params = ['comment' => [
            'commentable_type' => 'beatmapset',
            'commentable_id' => $this->beatmapset->getKey(),
            'message' => 'Hello.',
        ]];
    }
}
