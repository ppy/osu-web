<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\Beatmapset;
use App\Models\User;
use Faker;
use Tests\TestCase;

class BeatmapDiscussionsControllerTest extends TestCase
{
    protected static $faker;

    protected BeatmapDiscussion $discussion;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Faker\Factory::create();
    }

    /**
     * @dataProvider putVoteDataProvider
     */
    public function testPutVote(string $beatmapState, int $status, int $change)
    {
        $this->discussion->beatmapset->update(['approved' => Beatmapset::STATES[$beatmapState]]);

        $user = User::factory()->create();

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore();

        $this->putVote($user, '1')
            ->assertStatus($status);

        $this->assertSame($currentVotes + $change, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore + $change, $this->currentScore());
    }

    /**
     * @dataProvider putVoteAgainDataProvider
     */
    public function testPutVoteAgain(string $score, int $change)
    {
        $user = User::factory()->create();

        $this->discussion->vote([
            'score' => 1,
            'user_id' => $user->getKey(),
        ]);

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore();

        $this->putVote($user, $score)
            ->assertStatus(200);

        $this->assertSame($currentVotes + $change, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore + $change, $this->currentScore());
    }

    // can not vote as discussion starter
    public function testPutVoteSelf()
    {
        $user = $this->discussion->user;
        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore();

        $this->putVote($user, '1')
            ->assertStatus(403);

        $this->assertSame($currentVotes, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore, $this->currentScore());
    }

    /**
     * @dataProvider putVoteChangeDataProvider
     */
    public function testPutVoteChange(?string $group, int $status, int $scoreChange)
    {
        $user = User::factory()->withGroup($group)->create();

        $this->discussion->vote([
            'score' => 1,
            'user_id' => $user->getKey(),
        ]);

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore();

        $this
            ->putVote($user, '-1')
            ->assertStatus($status);

        $this->assertSame($currentVotes, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore + $scoreChange, $this->currentScore());
    }

    /**
     * @dataProvider putVoteDownDataProvider
     */
    public function testPutVoteDown(?string $group, int $status, int $voteChange, int $scoreChange)
    {
        $user = User::factory()->withGroup($group)->create();

        $currentVotes = BeatmapDiscussionVote::count();
        $currentScore = $this->currentScore();

        $this
            ->putVote($user, '-1')
            ->assertStatus($status);

        $this->assertSame($currentVotes + $voteChange, BeatmapDiscussionVote::count());
        $this->assertSame($currentScore + $scoreChange, $this->currentScore());
    }

    // posting reviews - fail scenarios ----

    // guest user
    public function testPostReviewGuest()
    {
        $this
            ->post(route('beatmapsets.discussion.review', $this->discussion->beatmapset_id))
            ->assertUnauthorized();
    }

    // invalid document
    public function testPostReviewDocumentMissing()
    {
        $this
            ->actingAsVerified($this->discussion->user)
            ->post(route('beatmapsets.discussion.review', $this->discussion->beatmapset_id))
            ->assertStatus(422);
    }

    // posting reviews - success scenario ----

    // valid document containing issue embeds
    public function testPostReviewDocumentValidWithIssues()
    {
        $user = $this->discussion->user;
        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();
        $timestampedIssueText = '00:01:234 '.self::$faker->sentence();
        $issueText = self::$faker->sentence();

        $document = json_encode(
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $timestampedIssueText,
                    'timestamp' => true,
                    'beatmap_id' => $this->discussion->beatmap_id,
                ],
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $issueText,
                ],
            ]
        );

        $this
            ->actingAsVerified($user)
            ->post(route('beatmapsets.discussion.review', $this->discussion->beatmapset_id), [
                'document' => $document,
            ])
            ->assertSuccessful()
            ->assertJsonFragment(
                [
                    'user_id' => $user->getKey(),
                    'message' => $timestampedIssueText,
                ]
            )
            // ensure timestamp was parsed correctly
            ->assertJsonFragment(
                [
                    'timestamp' => 1234,
                ]
            )
            ->assertJsonFragment(
                [
                    'user_id' => $user->getKey(),
                    'message' => $issueText,
                ]
            );

        // ensure 3 discussions/posts are created - one for the review and one for each embedded problem
        $this->assertSame($discussionCount + 3, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount + 3, BeatmapDiscussionPost::count());
    }

    public function putVoteDataProvider()
    {
        return [
            ['graveyard', 403, 0],
            ['wip', 200, 1],
            ['pending', 200, 1],
            ['ranked', 403, 0],
            ['approved', 403, 0],
            // TODO: qualified; factory the beatmapset with the correct state instead of using update.
            ['loved', 403, 0],
        ];
    }

    public function putVoteAgainDataProvider()
    {
        return [
            'voting again has no effect' => ['1', 0],
            'voting 0 will remove the vote' => ['0', -1],
        ];
    }

    public function putVoteChangeDataProvider()
    {
        return [
            'bng can change existing score' => ['bng', 200, -2],
            'regular user cannot change existing score' => [null, 403, 0],
        ];
    }

    public function putVoteDownDataProvider()
    {
        return [
            'bng can downvote' => ['bng', 200, 1, -1],
            'regular user cannot downvote' => [null, 403, 0, 0],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $mapper = User::factory()->create();
        $user = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'user_id' => $mapper,
            'discussion_enabled' => true,
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make([
            'user_id' => $mapper,
        ]));
        $this->discussion = BeatmapDiscussion::factory()->timeline()->create([
            'beatmapset_id' => $beatmapset,
            'beatmap_id' => $beatmap,
            'user_id' => $user,
        ]);
    }

    private function currentScore()
    {
        return (int) $this->discussion->fresh()->beatmapDiscussionVotes()->sum('score');
    }

    private function putVote(?User $user, string $score)
    {
        return $this
            ->actingAsVerified($user)
            ->put(route('beatmapsets.discussions.vote', $this->discussion), [
                'beatmap_discussion_vote' => ['score' => $score],
            ]);
    }
}
