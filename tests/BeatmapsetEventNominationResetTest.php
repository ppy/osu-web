<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetNomination;
use App\Models\User;
use Queue;

class BeatmapsetEventNominationResetTest extends TestCase
{
    private Beatmapset $beatmapset;

    /** @var User[] */
    private array $nominators;

    private User $sender;

    #region event logging tests
    public function testBeatmapsetEventsWhenDisqualified()
    {
        $this->createBeatmapsetWithNominators('qualified');

        $disqualifyCount = BeatmapsetEvent::disqualifications()->count();
        $nominationResetReceivedCount = BeatmapsetEvent::nominationResetReceiveds()->count();

        $this->postProblem()->assertStatus(200);

        Queue::assertPushed(BeatmapsetDisqualify::class);
        Queue::assertNotPushed(BeatmapsetResetNominations::class);

        $this->assertSame($disqualifyCount + 1, BeatmapsetEvent::disqualifications()->count());
        $this->assertSame($nominationResetReceivedCount + count($this->nominators), BeatmapsetEvent::nominationResetReceiveds()->count());
        $this->assertEqualsCanonicalizing(array_pluck($this->nominators, 'user_id'), BeatmapsetEvent::nominationResetReceiveds()->pluck('user_id')->all());
    }

    public function testBeatmapsetEventsWhenNotDisqualified()
    {
        $this->createBeatmapsetWithNominators('pending');

        $disqualifyCount = BeatmapsetEvent::disqualifications()->count();
        $nominationResetReceivedCount = BeatmapsetEvent::nominationResetReceiveds()->count();

        $this->postProblem()->assertStatus(200);

        Queue::assertNotPushed(BeatmapsetDisqualify::class);
        Queue::assertPushed(BeatmapsetResetNominations::class);

        $this->assertSame($disqualifyCount, BeatmapsetEvent::disqualifications()->count());
        $this->assertSame($nominationResetReceivedCount + count($this->nominators), BeatmapsetEvent::nominationResetReceiveds()->count());
        $this->assertEqualsCanonicalizing(array_pluck($this->nominators, 'user_id'), BeatmapsetEvent::nominationResetReceiveds()->pluck('user_id')->all());
    }
    #endregion

    // FIXME: disqualification tests could probably do with some reorganization.
    public function testInterOpDisqualify()
    {
        $this->createBeatmapsetWithNominators('qualified');
        $banchoBotUser = User::factory()->create([
            'user_id' => config('osu.legacy.bancho_bot_user_id'),
        ]);

        $disqualifyCount = BeatmapsetEvent::disqualifications()->count();
        $nominationResetReceivedCount = BeatmapsetEvent::nominationResetReceiveds()->count();

        $url = route('interop.beatmapsets.disqualify', [
            'beatmapset' => $this->beatmapset->getKey(),
            'timestamp' => time(),
        ]);

        $response = $this
            ->withInterOpHeader($url)
            ->post($url, ['message' => 'hello'])
            ->assertStatus(200);

        Queue::assertPushed(BeatmapsetDisqualify::class);
        Queue::assertNotPushed(BeatmapsetResetNominations::class);

        $this->beatmapset->refresh();

        $discussionId = json_decode($response->getContent(), true)['beatmapset_discussion_id'] ?? null;

        $this->assertNotEmpty($discussionId);

        $discussion = BeatmapDiscussion::find($discussionId);
        $this->assertTrue($banchoBotUser->is($discussion->user));
        $this->assertSame('hello', $discussion->startingPost->message);

        $this->assertSame($this->beatmapset->status(), 'pending');
        $this->assertSame($disqualifyCount + 1, BeatmapsetEvent::disqualifications()->count());
        $this->assertSame($nominationResetReceivedCount + count($this->nominators), BeatmapsetEvent::nominationResetReceiveds()->count());
        $this->assertEqualsCanonicalizing(array_pluck($this->nominators, 'user_id'), BeatmapsetEvent::nominationResetReceiveds()->pluck('user_id')->all());
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('osu.beatmapset.required_nominations', 2);

        Queue::fake();

        $this->sender = User::factory()->withGroup('bng')->create();
    }

    private function createBeatmapsetWithNominators($state)
    {
        $this->beatmapset = Beatmapset::factory()->owner()->$state()->withDiscussion()->create();

        $modes = $this->beatmapset->beatmaps->map->mode->all();
        $nominatorCount = config('osu.beatmapset.required_nominations');

        $this->nominators = [];

        for ($i = 0; $i < $nominatorCount; $i++) {
            $this->nominators[] = $nominator = User::factory()->withGroup('bng', $modes)->create();
            BeatmapsetNomination::factory()->create([
                'beatmapset_id' => $this->beatmapset,
                'user_id' => $nominator,
            ]);
        }
    }

    private function postProblem()
    {
        return $this
            ->actingAsVerified($this->sender)
            ->post(route('beatmapsets.discussions.posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);
    }
}
