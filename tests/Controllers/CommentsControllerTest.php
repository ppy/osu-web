<?php

namespace Tests\Controllers;

use App\Models\Beatmapset;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{
    public function testStore()
    {
        $user = factory(User::class)->create();
        $minimumLastPlayed = now()->subDays(config('osu.user.min_last_played_days_for_posting') - 1);
        $user->statisticsOsu()->create(['last_played' => $minimumLastPlayed->subDays(2)]);
        $otherUser = factory(User::class)->create();

        $beatmapset = factory(Beatmapset::class)->create();
        $follow = Follow::create([
            'notifiable' => $beatmapset,
            'user' => $otherUser,
            'subtype' => 'comment',
        ]);

        $currentComments = Comment::count();
        $currentNotifications = Notification::count();

        $params = ['comment' => [
            'commentable_type' => 'beatmapset',
            'commentable_id' => $beatmapset->getKey(),
            'message' => 'Hello.',
        ]];

        $this
            ->actingAsVerified($user)
            ->post(route('comments.store'), $params)
            ->assertStatus(403);

        $this->assertSame($currentComments, Comment::count());
        $this->assertSame($currentNotifications, Notification::count());

        $user->statisticsOsu->update(['last_played' => $minimumLastPlayed]);
        app()->make('OsuAuthorize')->cacheReset();

        $this
            ->actingAsVerified($user)
            ->post(route('comments.store'), $params)
            ->assertStatus(200);

        $this->assertSame($currentComments + 1, Comment::count());
        $this->assertSame($currentNotifications + 1, Notification::count());
    }

    public function testStoreReply()
    {
        $user = factory(User::class)->create();
        $minimumLastPlayed = now()->subDays(config('osu.user.min_last_played_days_for_posting') - 1);
        $user->statisticsOsu()->create(['last_played' => $minimumLastPlayed->subDays(2)]);

        $beatmapset = factory(Beatmapset::class)->create();
        $parent = $beatmapset->comments()->create([
            'user_id' => $user->getKey(),
            'message' => 'Hello.',
        ]);

        $params = ['comment' => [
            'parent_id' => $parent->getKey(),
            'message' => 'This is a reply.',
        ]];

        $currentComments = $beatmapset->comments()->count();

        $this
            ->actingAsVerified($user)
            ->post(route('comments.store'), $params)
            ->assertStatus(403);

        $this->assertSame($currentComments, $beatmapset->comments()->count());

        $user->statisticsOsu->update(['last_played' => $minimumLastPlayed]);
        app()->make('OsuAuthorize')->cacheReset();

        $this
            ->actingAsVerified($user)
            ->post(route('comments.store'), $params)
            ->assertStatus(200);

        $this->assertSame($currentComments + 1, $beatmapset->comments()->count());
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
}
