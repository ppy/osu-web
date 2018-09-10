<?php

use App\Models\Beatmapset;
use App\Models\Comment;
use App\Models\User;

class CommentsControllerTest extends TestCase
{
    public function testStore()
    {
        $user = factory(User::class)->create();

        $beatmapset = factory(Beatmapset::class)->create();
        $commentableType = 'beatmapset';
        $commentableId = $beatmapset->getKey();

        $currentComments = Comment::count();

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
}
