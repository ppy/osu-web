<?php

use App\Models\BeatmapSet;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\BeatmapsetDiscussion;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionVote;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DiscussionsControllerTest extends TestCase
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

    public function testPutVote()
    {
        // normal vote
        $currentVotes = BeatmapDiscussionVote::count();

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '1'],
                ])
            ->seeJson([]);

        $this->assertEquals($currentVotes + 1, BeatmapDiscussionVote::count());

        // voting again doesn't change anything
        $currentVotes = BeatmapDiscussionVote::count();

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '-1'],
                ])
            ->seeJson([]);

        $this->assertEquals($currentVotes, BeatmapDiscussionVote::count());

        // but voting 0 will remove the vote
        $currentVotes = BeatmapDiscussionVote::count();

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '0'],
            ])
            ->seeJson([]);

        $this->assertEquals($currentVotes - 1, BeatmapDiscussionVote::count());
    }
}
