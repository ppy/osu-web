<?php

namespace Tests\Controllers;

use App\Events\NewNotificationEvent;
use App\Events\NewPrivateNotificationEvent;
use App\Jobs\BroadcastNotification;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class BeatmapDiscussionPostsControllerTest extends TestCase
{
    public function testPostStoreNewDiscussion()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();
        $currentNotifications = Notification::count();
        $currentUserNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $this->beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'praise',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
        $this->assertSame($currentNotifications + 1, Notification::count());
        $this->assertSame($currentUserNotifications + 1, UserNotification::count());

        Event::assertDispatched(NewNotificationEvent::class);
        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    public function testPostStoreNewDiscussionInactiveBeatmapset()
    {
        $this->beatmapset = factory(Beatmapset::class)->states('inactive')->create([
            'user_id' => $this->mapper->getKey(),
        ]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'praise',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(404);
    }

    public function testPostStoreNewDiscussionNoteByMapper()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAsVerified($this->mapper)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'mapper_note',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewDiscussionNoteByNominator()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this->user->userGroups()->create(['group_id' => UserGroup::GROUPS['bng']]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'mapper_note',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewDiscussionNoteByOtherUser()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'mapper_note',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(403);

        $this->assertSame($currentDiscussions, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewReply()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewReplyReopenByMapper()
    {
        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => true]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(false, $this->beatmapset->user)
            ->assertStatus(200);

        // reopen adds system post
        $this->assertSame($lastDiscussionPosts + 2, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewReplyReopenByNominator()
    {
        $user = factory(User::class)->create();
        $user->userGroups()->create(['group_id' => UserGroup::GROUPS['bng']]);
        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => true]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(false, $user)
            ->assertStatus(200);

        // reopen adds system post
        $this->assertSame($lastDiscussionPosts + 2, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewReplyReopenByOtherUser()
    {
        $user = factory(User::class)->create();
        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => true]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(false, $user)
            ->assertStatus(200);

        // reopen adds system post
        $this->assertSame($lastDiscussionPosts + 2, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewReplyReopenByStarter()
    {
        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => true]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(false, $this->beatmapDiscussion->user)
            ->assertStatus(200);

        // reopen adds system post
        $this->assertSame($lastDiscussionPosts + 2, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewReplyResolve()
    {
        // can't change resolve status for praise
        $this->beatmapDiscussion->update(['message_type' => 'praise']);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();
        $lastResolved = $this->beatmapDiscussion->fresh()->resolved;

        $this
            ->postResolveDiscussion(false, $this->user)
            ->assertStatus(200);

        // just add single post and no resolved state change
        $this->assertSame($lastDiscussionPosts + 1, BeatmapDiscussionPost::count());
        $this->assertSame($lastResolved, $this->beatmapDiscussion->fresh()->resolved);

        foreach (['problem', 'suggestion'] as $type) {
            $this->beatmapDiscussion->update(['message_type' => $type]);
            $lastDiscussionPosts = BeatmapDiscussionPost::count();
            $lastResolved = $this->beatmapDiscussion->fresh()->resolved;

            $this
                ->postResolveDiscussion(!$lastResolved, $this->user)
                ->assertStatus(200);

            // each resolve adds system post
            $this->assertSame($lastDiscussionPosts + 2, BeatmapDiscussionPost::count());
            $this->assertSame(!$lastResolved, $this->beatmapDiscussion->fresh()->resolved);
        }
    }

    public function testPostStoreNewReplyResolveByOtherUser()
    {
        $user = factory(User::class)->create();
        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => false]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(true, $user)
            ->assertStatus(403);

        $this->assertSame($lastDiscussionPosts, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewDiscussionRequestBeatmapsetDiscussion()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->otherBeatmapset->beatmapset_id,
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
        $beatmapDiscussionPost = factory(BeatmapDiscussionPost::class)->create([
            'beatmap_discussion_id' => $this->beatmapDiscussion->id,
            'user_id' => $this->user->user_id,
        ]);

        $initialMessage = $beatmapDiscussionPost->message;
        $editedMessage = "{$initialMessage} Edited";

        $otherUser = factory(User::class)->create();

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
        $post = factory(BeatmapDiscussionPost::class)->create([
            'beatmap_discussion_id' => $this->beatmapDiscussion->id,
            'user_id' => $this->user->user_id,
        ]);
        $initialMessage = $post->message;

        $this->putPost('', $post)
            ->assertViewIs('users.login')
            ->assertStatus(401);

        $this->assertSame($initialMessage, $post->fresh()->message);
    }

    public function testPostUpdateWhenDiscussionResolved()
    {
        // reply made before resolve
        $reply1 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
            ])
        );
        $message1 = $reply1->message;

        $this->postResolveDiscussion(true, $this->user);

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
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
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
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
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
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
            ->put(route('beatmap-discussion-posts.update', $post->id), [
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
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
            ])
        );

        $this->deletePost($reply, $this->user)->assertStatus(200);
        $this->assertTrue($reply->fresh()->trashed());
    }

    public function testPostDestroyNotLoggedIn()
    {
        $reply = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
            ])
        );

        $this->deletePost($reply)
            ->assertViewIs('users.login')
            ->assertStatus(401);

        $this->assertFalse($reply->fresh()->trashed());
    }

    public function testPostDestroyWhenDiscussionResolved()
    {
        // reply made before resolve
        $reply1 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
            ])
        );

        $this->postResolveDiscussion(true, $this->user);

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
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
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
            ])
        );

        $this->postResolveDiscussion(true, $this->user);
        $this->postResolveDiscussion(false, $this->user);

        // still should not be able to delete reply made before first resolve.
        $this->deletePost($reply1, $this->user)->assertStatus(403);
        $this->assertFalse($reply1->fresh()->trashed());

        // reply made after resolve
        $reply2 = $this->beatmapDiscussion->beatmapDiscussionPosts()->save(
            factory(BeatmapDiscussionPost::class, 'timeline')->make([
                'user_id' => $this->user->getKey(),
            ])
        );

        $this->postResolveDiscussion(true, $this->user);

        // should not be able to delete either reply.
        $this->deletePost($reply1, $this->user)->assertStatus(403);
        $this->deletePost($reply2, $this->user)->assertStatus(403);
        $this->assertFalse($reply1->fresh()->trashed());
        $this->assertFalse($reply2->fresh()->trashed());
    }

    public function testProblemOnQualifiedBeatmapsetWithoutMatchingMode()
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);
        $this->beatmapset->beatmaps()->update(['playmode' => Beatmap::MODES['osu']]);
        $notificationOption = factory(User::class)->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => ['taiko']]]);

        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);

        $this
            ->actingAs($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    public function testProblemOnQualifiedBeatmapsetWithMatchingMode()
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);
        $this->beatmapset->beatmaps()->update(['playmode' => Beatmap::MODES['osu']]);
        $notificationOption = factory(User::class)->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => ['osu']]]);

        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);

        Event::assertDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider problemDataProvider
     */
    public function testProblemOnQualifiedBeatmap($updateParams, $assertMethod)
    {
        $this->beatmapset->update($updateParams);
        $notificationOption = factory(User::class)->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => array_keys(Beatmap::MODES)]]);

        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);

        $assertMethod(NewPrivateNotificationEvent::class);
    }

    public function testSecondProblemOnQualifiedBeatmapset()
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);
        $notificationOption = factory(User::class)->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => array_keys(Beatmap::MODES)]]);

        $this
            ->actingAs($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider problemQueueDataProvider
     */
    public function testProblemOnQualifiedBeatmapQueuesNotification($userStates, $queued, $notQueued)
    {
        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);

        // faking prevents jobs from actually running, so events and jobs can't be asserted together.
        Queue::fake();

        $factory = factory(User::class);
        if ($userStates !== null) {
            $factory->states($userStates);
        }

        $user = $factory->create();

        $this
            ->actingAsVerified($user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);

        $remaining = $queued;
        // assertPushed only asserts if any matching job was queued.
        Queue::assertPushed(BroadcastNotification::class, function ($job) use ($queued, &$remaining) {
            $inArray = in_array($job->getName(), $queued, true);

            if (($key = array_search($job->getName(), $remaining, true)) !== false) {
                unset($remaining[$key]);
            }

            return $inArray;
        });

        $this->assertEmpty(array_values($remaining));

        Queue::assertNotPushed(BroadcastNotification::class, function ($job) use ($notQueued) {
            return in_array($job->getName(), $notQueued, true);
        });
    }

    public function problemDataProvider()
    {
        return [
            [['approved' => Beatmapset::STATES['qualified'], 'queued_at' => now()], 'Event::assertDispatched'],
            [['approved' => Beatmapset::STATES['pending']], 'Event::assertNotDispatched'],
        ];
    }

    public function problemQueueDataProvider()
    {
        return [
            [
                'bng',
                [Notification::BEATMAPSET_DISQUALIFY, Notification::BEATMAPSET_DISCUSSION_POST_NEW, Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM],
                [],
            ],
            [
                null,
                [Notification::BEATMAPSET_DISCUSSION_POST_NEW, Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM],
                [Notification::BEATMAPSET_DISQUALIFY],
            ],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->mapper = factory(User::class)->create();
        $this->user = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $this->mapper->getKey(),
        ]);
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $this->beatmapDiscussion = factory(BeatmapDiscussion::class, 'timeline')->create([
            'beatmapset_id' => $this->beatmapset->getKey(),
            'beatmap_id' => $this->beatmap->getKey(),
            'user_id' => $this->user->getKey(),
        ]);
        $post = factory(BeatmapDiscussionPost::class, 'timeline')->make([
            'user_id' => $this->user->getKey(),
        ]);
        $this->beatmapDiscussionPost = $this->beatmapDiscussion->beatmapDiscussionPosts()->save($post);

        $this->otherBeatmapset = factory(Beatmapset::class)->states('no_discussion')->create();
        $this->otherBeatmap = $this->otherBeatmapset->beatmaps()->save(factory(Beatmap::class)->make());
    }

    private function deletePost(BeatmapDiscussionPost $post, ?User $user = null)
    {
        return ($user === null ? $this : $this->actingAsVerified($user))
            ->delete(route('beatmap-discussion-posts.destroy', $post->id));
    }

    private function postResolveDiscussion(bool $resolved, User $user)
    {
        return $this
            ->actingAsVerified($user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion' => [
                    'resolved' => $resolved,
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);
    }

    private function putPost(string $message, BeatmapDiscussionPost $post, ?User $user = null)
    {
        return ($user === null ? $this : $this->actingAsVerified($user))
            ->put(route('beatmap-discussion-posts.update', $post->id), [
                'beatmap_discussion_post' => [
                    'message' => $message,
                ],
            ]);
    }
}
