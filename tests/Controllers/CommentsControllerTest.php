<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmapset;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{
    private $user;
    private $minPlays;
    private $beatmapset;
    private $params;

    public function testStore()
    {
        $this->prepareForStore();
        $otherUser = factory(User::class)->create();

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
        $comment = factory(Comment::class)->create();

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

    private function prepareForStore()
    {
        config()->set('osu.user.post_action_verification', false);

        $this->user = factory(User::class)->create();
        $this->minPlays = config('osu.user.min_plays_for_posting');
        $this->user->statisticsOsu()->create(['playcount' => $this->minPlays]);

        $this->beatmapset = Beatmapset::factory()->create();

        $this->params = ['comment' => [
            'commentable_type' => 'beatmapset',
            'commentable_id' => $this->beatmapset->getKey(),
            'message' => 'Hello.',
        ]];
    }
}
