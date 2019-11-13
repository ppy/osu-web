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
        $otherUser = factory(User::class)->create();

        $beatmapset = factory(Beatmapset::class)->create();
        $follow = Follow::create([
            'notifiable' => $beatmapset,
            'user' => $otherUser,
            'subtype' => 'comment',
        ]);

        $commentableType = 'beatmapset';
        $commentableId = $beatmapset->getKey();

        $currentComments = Comment::count();
        $currentNotifications = Notification::count();

        $this
            ->actingAs($user)
            ->post(route('comments.store'), [
                'comment' => [
                    'commentable_type' => $commentableType,
                    'commentable_id' => $commentableId,
                    'message' => 'Hello.',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentComments + 1, Comment::count());
        $this->assertSame($currentNotifications + 1, Notification::count());
    }

    public function testStoreReply()
    {
        $user = factory(User::class)->create();

        $beatmapset = factory(Beatmapset::class)->create();
        $parent = $beatmapset->comments()->create([
            'user_id' => $user->getKey(),
            'message' => 'Hello.',
        ]);

        $currentComments = $beatmapset->comments()->count();

        $this
            ->actingAs($user)
            ->post(route('comments.store'), [
                'comment' => [
                    'parent_id' => $parent->getKey(),
                    'message' => 'This is a reply.',
                ],
            ])
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
