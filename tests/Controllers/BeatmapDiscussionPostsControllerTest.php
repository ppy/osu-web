<?php

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetDiscussion;
use App\Models\User;

class BeatmapDiscussionPostsControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->create();
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $this->beatmapsetDiscussion = BeatmapsetDiscussion::create(['beatmapset_id' => $this->beatmap->beatmapset_id]);
        $this->beatmapDiscussion = factory(BeatmapDiscussion::class, 'timeline')->create([
            'beatmapset_discussion_id' => $this->beatmapsetDiscussion->id,
            'beatmap_id' => $this->beatmap->beatmap_id,
            'user_id' => $this->user->user_id,
        ]);

        $this->otherBeatmapset = factory(Beatmapset::class)->create();
        $this->otherBeatmap = $this->otherBeatmapset->beatmaps()->save(factory(Beatmap::class)->make());
    }

    public function testPostStoreNewDiscussion()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAs($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewReply()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAs($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussions, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());

        // changing resolve status adds two posts
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAs($this->user)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmap_discussion_id' => $this->beatmapDiscussion->id,
                'beatmap_discussion' => [
                    'resolved' => !$this->beatmapDiscussion->fresh()->resolved,
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($currentDiscussionPosts + 2, BeatmapDiscussionPost::count());
    }

    public function testPostStoreNewDiscussionRequestBeatmapsetDiscussion()
    {
        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();

        $this
            ->actingAs($this->user)
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
            ->actingAs($otherUser)
            ->put(route('beatmap-discussion-posts.update', $beatmapDiscussionPost->id), [
                'beatmap_discussion_post' => [
                    'message' => $editedMessage,
                ],
            ])
            ->assertStatus(403);

        $beatmapDiscussionPost = $beatmapDiscussionPost->fresh();

        $this->assertSame($initialMessage, $beatmapDiscussionPost->message);

        // correct user
        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussion-posts.update', $beatmapDiscussionPost->id), [
                'beatmap_discussion_post' => [
                    'message' => $editedMessage,
                ],
            ])
            ->assertStatus(200);

        $beatmapDiscussionPost = $beatmapDiscussionPost->fresh();

        $this->assertSame($editedMessage, $beatmapDiscussionPost->message);
    }
}
