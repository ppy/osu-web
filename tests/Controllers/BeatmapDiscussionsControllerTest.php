<?php

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionVote;
use App\Models\Beatmapset;
use App\Models\BeatmapsetDiscussion;
use App\Models\User;

class BeatmapDiscussionsControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
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
        // can not vote as discussion starter
        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->user)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '1'],
            ])
            ->assertStatus(403);

        $this->assertSame($currentVotes, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore, $this->currentScore($this->beatmapDiscussion));

        // and then no problem as another user
        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->anotherUser)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '1'],
            ])
            ->assertStatus(200);

        $this->assertSame($currentVotes + 1, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore + 1, $this->currentScore($this->beatmapDiscussion));
    }

    // voting again only changes the score
    public function testPutVoteChange()
    {
        $this->beatmapDiscussion->vote(['score' => 1, 'user_id' => $this->anotherUser->user_id]);

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->anotherUser)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '-1'],
            ])
            ->assertStatus(200);

        $this->assertSame($currentVotes, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore - 2, $this->currentScore($this->beatmapDiscussion));
    }

    // voting 0 will remove the vote
    public function testPutVoteRemove()
    {
        $this->beatmapDiscussion->vote(['score' => 1, 'user_id' => $this->anotherUser->user_id]);

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore($this->beatmapDiscussion);

        $this
            ->actingAs($this->anotherUser)
            ->put(route('beatmap-discussions.vote', $this->beatmapDiscussion), [
                'beatmap_discussion_vote' => ['score' => '0'],
            ])
            ->assertStatus(200);

        $this->assertSame($currentVotes - 1, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore - 1, $this->currentScore($this->beatmapDiscussion));
    }

    private function currentScore($discussion)
    {
        return (int) $discussion->fresh()->beatmapDiscussionVotes()->sum('score');
    }
}
