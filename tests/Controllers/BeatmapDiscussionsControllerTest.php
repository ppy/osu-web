<?php

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionVote;
use App\Models\Beatmapset;
use App\Models\BeatmapsetDiscussion;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeatmapDiscussionsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $this->user->user_id,
        ]);
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make([
            'user_id' => $this->user->user_id,
        ]));
        $this->beatmapsetDiscussion = BeatmapsetDiscussion::create([
            'beatmapset_id' => $this->beatmapset->beatmapset_id,
        ]);
        $this->beatmapDiscussion = BeatmapDiscussion::create([
            'beatmapset_discussion_id' => $this->beatmapsetDiscussion->id,
            'timestamp' => 0,
            'message_type' => 'praise',
            'beatmap_id' => $this->beatmap->beatmap_id,
            'user_id' => $this->user->user_id,
        ]);
    }

    // normal vote
    public function testPutVoteInitial()
    {
        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '1'],
            ])
            ->assertResponseOk();

        $this->assertEquals($currentVotes + 1, BeatmapDiscussionVote::count());
        $this->assertEquals($currentScore + 1, $this->currentScore($this->beatmapDiscussion));
    }

    // voting again only changes the score
    public function testPutVoteChange()
    {
        $this->beatmapDiscussion->vote(['score' => 1, 'user_id' => $this->user->user_id]);

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '-1'],
            ])
            ->assertResponseOk();

        $this->assertEquals($currentVotes, BeatmapDiscussionVote::count());
        $this->assertEquals($currentScore - 2, $this->currentScore($this->beatmapDiscussion));
    }

    // voting 0 will remove the vote
    public function testPutVoteRemove()
    {
        $this->beatmapDiscussion->vote(['score' => 1, 'user_id' => $this->user->user_id]);

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '0'],
            ])
            ->assertResponseOk();

        $this->assertEquals($currentVotes - 1, BeatmapDiscussionVote::count());
        $this->assertEquals($currentScore - 1, $this->currentScore($this->beatmapDiscussion));
    }

    private function currentScore($discussion)
    {
        return $discussion->fresh()->beatmapDiscussionVotes()->sum('score');
    }
}
