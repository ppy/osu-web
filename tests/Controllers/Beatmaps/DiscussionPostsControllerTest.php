<?php

use App\Models\BeatmapSet;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\BeatmapsetDiscussion;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeatmapsDiscussionPostsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->beatmapset = factory(BeatmapSet::class)->create();
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $this->beatmapsetDiscussion = BeatmapsetDiscussion::create(['beatmapset_id' => $this->beatmap->beatmapset_id]);
        $this->beatmapDiscussion = BeatmapDiscussion::create([
            'beatmapset_discussion_id' => $this->beatmapsetDiscussion->id,
            'timestamp' => 0,
            'message_type' => 'praise',
            'beatmap_id' => $this->beatmap->beatmap_id,
        ]);

        $this->otherBeatmapset = factory(BeatmapSet::class)->create();
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
            ->seeJson([]);

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
            ->seeJson([]);

        $this->assertEquals($currentDiscussions, BeatmapDiscussion::count());
        $this->assertEquals($currentDiscussionPosts + 1, BeatmapDiscussionPost::count());
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
}
