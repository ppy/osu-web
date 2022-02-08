<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Events\NewPrivateNotificationEvent;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class BeatmapDiscussionPostsControllerTest extends TestCase
{
    private Beatmap $beatmap;
    private BeatmapDiscussion $beatmapDiscussion;
    private BeatmapDiscussionPost $beatmapDiscussionPost;
    private Beatmapset $beatmapset;
    private User $mapper;
    private User $user;

    /**
     * @dataProvider postStoreNewDiscussionMinPlaysDataProvider
     */
    public function testPostStoreNewDiscussionMinPlays(?int $minPlays, bool $verified, bool $success)
    {
        config()->set('osu.user.post_action_verification', false);
        $user = User::factory()->withPlays($minPlays)->create();
        $watcher = User::factory()->create();
        $this->beatmapset->watches()->create(['user_id' => $watcher->getKey()]);
        $params = $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'praise');

        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();
        $currentNotifications = Notification::count();
        $currentUserNotifications = UserNotification::count();

        $this->actAsUser($user, $verified);
        $request = $this->post(route('beatmapsets.discussions.posts.store'), $params);

        if ($success) {
            $request->assertStatus(200);
        } else {
            $request->assertStatus(401)->assertViewIs('users.verify');
        }

        $change = $success ? 1 : 0;
        $this->assertSame($currentDiscussions + $change, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + $change, BeatmapDiscussionPost::count());
        $this->assertSame($currentNotifications + $change, Notification::count());
        $this->assertSame($currentUserNotifications + $change, UserNotification::count());

        if ($success) {
            Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($watcher) {
                // assert watchers in receivers and sender is not.
                return in_array($watcher->getKey(), $event->getReceiverIds(), true)
                    && !in_array($this->user->getKey(), $event->getReceiverIds(), true);
            });
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
    }

    public function testPostStoreNewDiscussionInactiveBeatmapset()
    {
        $beatmapset = Beatmapset::factory()->owner()->inactive()->create();

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($beatmapset, 'praise'))
            ->assertStatus(404);
    }

    public function testPostStoreNewDiscussionNoteByMapper()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAsVerified($this->mapper)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'mapper_note'))
            ->assertStatus(200);

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewDiscussionNoteByMapperOnGuestBeatmap()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();
        $this->beatmap->update(['user_id' => $this->user->getKey()]);

        $params = $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'mapper_note');
        $params['beatmap_discussion']['beatmap_id'] = $this->beatmap->getKey();
        $this
            ->actingAsVerified($this->mapper)
            ->post(route('beatmapsets.discussions.posts.store'), $params)
            ->assertSuccessful();

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewDiscussionNoteByGuestOnGuestBeatmap()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();
        $this->beatmap->update(['user_id' => $this->user->getKey()]);

        $params = $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'mapper_note');
        $params['beatmap_discussion']['beatmap_id'] = $this->beatmap->getKey();
        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $params)
            ->assertSuccessful();

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewDiscussionNoteByNominator()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this->user->addToGroup(app('groups')->byIdentifier('bng'));

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'mapper_note'))
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
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'mapper_note'))
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
            ->post(route('beatmapsets.discussions.posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    /**
     * @dataProvider postStoreNewReplyByOtherUserDataProvider
     */
    public function testPostStoreNewReplyByOtherUserResolved(?string $group)
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);

        $user = User::factory()->withGroup($group)->withPlays()->create();

        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => true]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(false, $user)
            ->assertStatus(200);

        // reopen adds system post
        $this->assertSame($lastDiscussionPosts + 2, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
        $this->assertSame($this->beatmapset->refresh()->approved, Beatmapset::STATES['qualified']);
    }

    /**
     * @dataProvider postStoreNewReplyByOtherUserDataProvider
     */
    public function testPostStoreNewReplyByOtherUserUnresolved(?string $group)
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);

        $user = User::factory()->withGroup($group)->withPlays()->create();

        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => false]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(false, $user)
            ->assertStatus(200);

        $this->assertSame($lastDiscussionPosts + 1, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
        $this->assertSame($this->beatmapset->refresh()->approved, Beatmapset::STATES['qualified']);
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

    public function testPostStoreNewReplyResolveByMapperOnGuestBeatmap()
    {
        $guest = User::factory()->create();
        $this->beatmap->update(['user_id' => $guest->getKey()]);
        $this->beatmapDiscussion->update([
            'beatmap_id' => $this->beatmap->getKey(),
            'message_type' => 'problem',
            'resolved' => false,
        ]);
        $discussionPostCount = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(true, $this->mapper)
            ->assertSuccessful();

        $this->assertSame($discussionPostCount + 2, BeatmapDiscussionPost::count());
        $this->assertTrue($this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewReplyResolveByGuest()
    {
        $guest = User::factory()->create();
        $this->beatmap->update(['user_id' => $guest->getKey()]);
        $this->beatmapDiscussion->update([
            'beatmap_id' => $this->beatmap->getKey(),
            'message_type' => 'problem',
            'resolved' => false,
        ]);
        $discussionPostCount = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(true, $guest)
            ->assertSuccessful();

        $this->assertSame($discussionPostCount + 2, BeatmapDiscussionPost::count());
        $this->assertTrue($this->beatmapDiscussion->fresh()->resolved);
    }

    public function testPostStoreNewReplyResolveByOtherUser()
    {
        $user = User::factory()->create();
        $this->beatmapDiscussion->update(['message_type' => 'problem', 'resolved' => false]);
        $lastDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->postResolveDiscussion(true, $user)
            ->assertStatus(403);

        $this->assertSame($lastDiscussionPosts, BeatmapDiscussionPost::count());
        $this->assertSame(false, $this->beatmapDiscussion->fresh()->resolved);
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

    public function testProblemOnQualifiedBeatmapsetWithoutMatchingMode()
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);
        $this->beatmapset->beatmaps()->update(['playmode' => Beatmap::MODES['osu']]);
        $notificationOption = User::factory()->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => ['taiko']]]);

        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);

        $this
            ->actingAs($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'problem'));

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    public function testProblemOnQualifiedBeatmapsetWithMatchingMode()
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);
        $this->beatmapset->beatmaps()->update(['playmode' => Beatmap::MODES['osu']]);
        $user = User::factory()->create();
        $notificationOption = $user->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => ['osu']]]);

        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'problem'));

        Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($user) {
            return in_array($user->getKey(), $event->getReceiverIds(), true);
        });
    }

    /**
     * @dataProvider problemDataProvider
     */
    public function testProblemOnQualifiedBeatmap($updateParams, $assertMethod)
    {
        $this->beatmapset->update($updateParams);
        $notificationOption = User::factory()->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => array_keys(Beatmap::MODES)]]);

        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);

        $this
            ->actingAsVerified($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'problem'));

        $assertMethod(NewPrivateNotificationEvent::class);
    }

    public function testSecondProblemOnQualifiedBeatmapset()
    {
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES['qualified'],
            'queued_at' => now(),
        ]);
        $notificationOption = User::factory()->create()->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => array_keys(Beatmap::MODES)]]);

        $this
            ->actingAs($this->user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'problem'));

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider problemQueueDataProvider
     */
    public function testProblemOnBeatmapQueuesNotification(string $beatmapState, ?string $userGroup, array $queued, array $notQueued)
    {
        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES[$beatmapState],
            'queued_at' => $beatmapState === 'qualified' ? now() : null,
        ]);

        // faking prevents jobs from actually running, so events and jobs can't be asserted together.
        Queue::fake();

        $user = User::factory()->withGroup($userGroup)->withPlays()->create();

        $this
            ->actingAsVerified($user)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($this->beatmapset, 'problem'));

        foreach ($queued as $class) {
            Queue::assertPushed($class);
        }

        foreach ($notQueued as $class) {
            Queue::assertNotPushed($class);
        }
    }

    /**
     * @dataProvider reopenProblemQueueDataProvider
     */
    public function testReopenProblemOnBeatmapQueuesNotification($beatmapState, $userGroup, $queued, $notQueued)
    {
        // ensure there's no currently open problems
        $this->beatmapset->beatmapDiscussions()->ofType('problem')->update(['resolved' => true]);
        $this->beatmapset->update([
            'approved' => Beatmapset::STATES[$beatmapState],
            'queued_at' => $beatmapState === 'qualified' ? now() : null,
        ]);

        // faking prevents jobs from actually running, so events and jobs can't be asserted together.
        Queue::fake();

        $user = User::factory()->withGroup($userGroup)->withPlays()->create();

        $this
            ->postResolveDiscussion(false, $user)
            ->assertStatus(200);

        foreach ($queued as $class) {
            Queue::assertPushed($class);
        }

        foreach ($notQueued as $class) {
            Queue::assertNotPushed($class);
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

    public function postStoreNewReplyByOtherUserDataProvider()
    {
        return [
            ['admin'],
            ['bng'],
            ['gmt'],
            ['nat'],
            [null],
        ];
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
                'qualified',
                'bng',
                [BeatmapsetDisqualify::class, BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetResetNominations::class],
            ],
            [
                'qualified',
                null,
                [BeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'pending',
                'bng',
                // no BeatmapsetResetNominations event expected because these tests have no nominations;
                // see BeatmapsetEventNominationResetTest
                [BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'pending',
                null,
                [BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
        ];
    }

    public function reopenProblemQueueDataProvider()
    {
        return [
            [
                'qualified',
                'bng',
                [BeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'qualified',
                null,
                [BeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'pending',
                'bng',
                // no BeatmapsetResetNominations event expected because these tests have no nominations;
                // see BeatmapsetEventNominationResetTest
                [BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'pending',
                null,
                [BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
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
