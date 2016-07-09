<?php

use App\Models\Beatmapset;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\BeatmapsetDiscussion;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeatmapDiscussionPostsControllerTest extends TestCase
{
    use DatabaseTransactions;

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
            ->assertResponseOk();

        $this->assertEquals($currentDiscussions + 1, BeatmapDiscussion::count());
        $this->assertEquals($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
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
            ->assertResponseOk();

        $this->assertEquals($currentDiscussions, BeatmapDiscussion::count());
        $this->assertEquals($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());

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
            ->assertResponseOk();

        $this->assertEquals($currentDiscussionPosts + 2, BeatmapDiscussionPost::count());
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
            ->assertResponseStatus(404);

        $this->assertEquals($currentDiscussions, BeatmapDiscussion::count());
        $this->assertEquals($currentDiscussionPosts, BeatmapDiscussionPost::count());
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
            ->assertResponseStatus(403);

        $beatmapDiscussionPost = $beatmapDiscussionPost->fresh();

        $this->assertEquals($initialMessage, $beatmapDiscussionPost->message);

        // correct user
        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussion-posts.update', $beatmapDiscussionPost->id), [
                'beatmap_discussion_post' => [
                    'message' => $editedMessage,
                ],
            ])
            ->assertResponseOk();

        $beatmapDiscussionPost = $beatmapDiscussionPost->fresh();

        $this->assertEquals($editedMessage, $beatmapDiscussionPost->message);
    }
}
