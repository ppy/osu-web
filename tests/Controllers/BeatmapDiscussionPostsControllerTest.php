<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BeatmapDiscussionPostsControllerTest extends TestCase
{
    private Beatmap $beatmap;
    private BeatmapDiscussion $beatmapDiscussion;
    private BeatmapDiscussionPost $beatmapDiscussionPost;
    private Beatmapset $beatmapset;
    private User $mapper;
    private User $user;

    public function testPostStoreNewDiscussionInactiveBeatmapset()
    {
        $beatmapset = Beatmapset::factory()->owner()->inactive()->create();

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($beatmapset, 'praise'))
            ->assertStatus(404);
    }

    public function testPostStoreNewDiscussionRequestBeatmapsetDiscussionDisabled()
    {
        $beatmapset = Beatmapset::factory()->noDiscussion()->has(Beatmap::factory())->create();

        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), [
                'beatmapset_id' => $beatmapset->getKey(),
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(404);

        $this->assertSame($currentDiscussions, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts, BeatmapDiscussionPost::count());
    }

    public function testPostUpdate()
    {
        $beatmapDiscussionPost = BeatmapDiscussionPost::factory()->create([
            'beatmap_discussion_id' => $this->beatmapDiscussion->id,
            'user_id' => $this->user->user_id,
        ]);

        $initialMessage = $beatmapDiscussionPost->message;
        $editedMessage = "{$initialMessage} Edited";

        $otherUser = User::factory()->create();

        // invalid user
        $this
            ->putPost($editedMessage, $beatmapDiscussionPost, $otherUser)
            ->assertStatus(403);

        $beatmapDiscussionPost = $beatmapDiscussionPost->fresh();

        $this->assertSame($initialMessage, $beatmapDiscussionPost->message);

        // correct user
        $this
            ->putPost($editedMessage, $beatmapDiscussionPost, $this->user)
            ->assertStatus(200);

        $beatmapDiscussionPost = $beatmapDiscussionPost->fresh();

        $this->assertSame($editedMessage, $beatmapDiscussionPost->message);
    }

    public function testPostUpdateNotLoggedIn()
    {
        $post = BeatmapDiscussionPost::factory()->create([
            'beatmap_discussion_id' => $this->beatmapDiscussion,
            'user_id' => $this->user,
        ]);
        $initialMessage = $post->message;

        $this->putPost('', $post)
            ->assertViewIs('users.login')
            ->assertStatus(401);

        $this->assertSame($initialMessage, $post->fresh()->message);
    }

    public function testPostUpdateWhenBeatmapsetDiscussionIsLocked()
    {
        $reply = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );
        $message = $reply->message;

        $this->beatmapset->update(['discussion_locked' => true]);

        $this->putPost("{$message} edited", $reply, $this->user)->assertStatus(403);
        $this->assertSame($message, $reply->fresh()->message);
    }

    public function testPostUpdateWhenDiscussionResolved()
    {
        // reply made before resolve
        $reply1 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );
        $message1 = $reply1->message;

        $this->postResolveDiscussion(true, $this->user);

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );
        $message2 = $reply2->message;

        $this->putPost("{$message1} edited", $reply1, $this->user)->assertStatus(403);
        $this->putPost("{$message2} edited", $reply2, $this->user)->assertSuccessful();
        $this->assertSame($message1, $reply1->fresh()->message);
        $this->assertSame("{$message2} edited", $reply2->fresh()->message);
    }

    public function testPostUpdateWhenDiscussionReResolved()
    {
        // reply made before resolve
        $reply1 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );
        $message1 = $reply1->message;

        $this->postResolveDiscussion(true, $this->user);
        $this->postResolveDiscussion(false, $this->user);

        // still should not be able to edit reply made before first resolve.
        $this->putPost("{$message1} edited", $reply1, $this->user)->assertStatus(403);
        $this->assertSame($message1, $reply1->fresh()->message);

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );
        $message2 = $reply2->message;

        $this->postResolveDiscussion(true, $this->user);

        // should not be able to edit either reply.
        $this->putPost("{$message1} edited", $reply1, $this->user)->assertStatus(403);
        $this->putPost("{$message2} edited", $reply2, $this->user)->assertStatus(403);
        $this->assertSame($message1, $reply1->fresh()->message);
        $this->assertSame($message2, $reply2->fresh()->message);
    }

    public function testStartingPostUpdate()
    {
        $post = $this->beatmapDiscussionPost;

        $previousTimestamp = $post->beatmapDiscussion->timestamp;

        // removing timestamp isn't allowed
        $this
            ->putPost('Missing timestamp.', $post, $this->user)
            ->assertStatus(422);

        $post = $post->fresh();
        $this->assertSame($previousTimestamp, $post->beatmapDiscussion->timestamp);

        $newTimestamp = $post->beatmapDiscussion->beatmap->total_length * 1000;
        $newTimestampString = beatmap_timestamp_format($newTimestamp);

        // changing timestamp is allowed
        $this
            ->actingAs($this->user)
            ->put(route('beatmapsets.discussions.posts.update', $post->id), [
                'beatmap_discussion_post' => [
                    'message' => "{$newTimestampString} Edited timestamp.",
                ],
            ])
            ->assertStatus(200);

        $post = $post->fresh();
        $this->assertSame($newTimestamp, $post->beatmapDiscussion->timestamp);
    }

    public function testPostDestroy()
    {
        $reply = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->deletePost($reply, $this->user)->assertStatus(200);
        $this->assertTrue($reply->fresh()->trashed());
    }

    public function testPostDestroyNotLoggedIn()
    {
        $reply = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->deletePost($reply)
            ->assertViewIs('users.login')
            ->assertStatus(401);

        $this->assertFalse($reply->fresh()->trashed());
    }

    public function testPostDestroyWhenBeatmapsetDiscussionIsLocked()
    {
        $reply = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->beatmapset->update(['discussion_locked' => true]);

        $this->deletePost($reply, $this->user)->assertStatus(403);
        $this->assertFalse($reply->fresh()->trashed());
    }

    public function testPostDestroyWhenDiscussionResolved()
    {
        // reply made before resolve
        $reply1 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->postResolveDiscussion(true, $this->user);

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->deletePost($reply1, $this->user)->assertStatus(403);
        $this->deletePost($reply2, $this->user)->assertSuccessful();
        $this->assertFalse($reply1->fresh()->trashed());
        $this->assertTrue($reply2->fresh()->trashed());
    }

    public function testPostDestroyWhenDiscussionReResolved()
    {
        // reply made before resolve
        $reply1 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->postResolveDiscussion(true, $this->user);
        $this->postResolveDiscussion(false, $this->user);

        // still should not be able to delete reply made before first resolve.
        $this->deletePost($reply1, $this->user)->assertStatus(403);
        $this->assertFalse($reply1->fresh()->trashed());

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            BeatmapDiscussionPost::factory()->timeline()->make([
                'user_id' => $this->user,
            ])
        );

        $this->postResolveDiscussion(true, $this->user);

        // should not be able to delete either reply.
        $this->deletePost($reply1, $this->user)->assertStatus(403);
        $this->deletePost($reply2, $this->user)->assertStatus(403);
        $this->assertFalse($reply1->fresh()->trashed());
        $this->assertFalse($reply2->fresh()->trashed());
    }

    public function testPostWithoutResolveFlag()
    {
        $this->beatmapDiscussion->update([
            'resolved' => false,
        ]);

        $otherUser = User::factory()->withPlays()->create();

        foreach ([$this->user, $otherUser] as $user) {
            $lastDiscussionPosts = BeatmapDiscussionPost::count();

            $this
                ->postDiscussionWithoutResolveFlag($user)
                ->assertStatus(200);

            // No resolve change, therefore no system posts
            $this->assertSame($lastDiscussionPosts + 1, BeatmapDiscussionPost::count());
            // Should stay unresolved.
            $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
        }

        $this
            ->postResolveDiscussion(true, $this->user)
            ->assertStatus(200);

        foreach ([$this->user, $otherUser] as $user) {
            $lastDiscussionPosts = BeatmapDiscussionPost::count();

            $this
                ->postDiscussionWithoutResolveFlag($user)
                ->assertStatus(200);

            $this->assertSame($lastDiscussionPosts + 1, BeatmapDiscussionPost::count());
            // Should stay resolved now.
            $this->assertSame(true, $this->beatmapDiscussion->fresh()->resolved);
        }
    }

    public function postStoreNewDiscussionMinPlaysDataProvider()
    {
        return [
            [config('osu.user.min_plays_for_posting') - 1, false, false],
            [config('osu.user.min_plays_for_posting') - 1, true, true],
            [null, false, true],
            [null, true, true],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->mapper = User::factory()->withPlays()->create();
        $this->user = User::factory()->withPlays()->create();

        $this->beatmapset = Beatmapset::factory()->owner($this->mapper)->create();
        $this->beatmap = $this->beatmapset->beatmaps()->save(Beatmap::factory()->make([
            'user_id' => $this->mapper->getKey(),
        ]));
        $this->beatmapDiscussion = BeatmapDiscussion::factory()->timeline()->create([
            'beatmapset_id' => $this->beatmapset,
            'beatmap_id' => $this->beatmap,
            'user_id' => $this->user,
        ]);
        $post = BeatmapDiscussionPost::factory()->timeline()->make([
            'user_id' => $this->user,
        ]);
        $this->beatmapDiscussionPost = $this->beatmapDiscussion->beatmapDiscussionPosts()->save($post);
    }

    private function deletePost(BeatmapDiscussionPost $post, ?User $user = null)
    {
        return ($user === null ? $this : $this->actingAsVerified($user))
            ->delete(route('beatmapsets.discussions.posts.destroy', $post->id));
    }

    private function postResolveDiscussion(bool $resolved, User $user)
    {
        return $this
            ->actingAsVerified($user)
            ->post(route('beatmapsets.discussions.posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion' => [
                    'resolved' => $resolved,
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);
    }

    private function postDiscussionWithoutResolveFlag(User $user)
    {
        return $this
            ->actingAsVerified($user)
            ->post(route('beatmapsets.discussions.posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion' => [],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);
    }

    private function putPost(string $message, BeatmapDiscussionPost $post, ?User $user = null)
    {
        return ($user === null ? $this : $this->actingAsVerified($user))
            ->put(route('beatmapsets.discussions.posts.update', $post->id), [
                'beatmap_discussion_post' => [
                    'message' => $message,
                ],
            ]);
    }
}
