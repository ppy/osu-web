<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetNomination;
use App\Models\User;
use Queue;

class BeatmapsetEventNominationResetTest extends TestCase
{
    /** @var Beatmapset */
    private $beatmapset;

    /** @var User[] */
    private $nominators;

    /** @var User */
    private $sender;

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

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('osu.beatmapset.required_nominations', 2);

        Queue::fake();

        $this->sender = $this->createUserWithGroup('bng');
    }

    private function createBeatmapsetWithNominators($state)
    {
        $owner = factory(User::class)->create();

        $this->beatmapset = factory(Beatmapset::class)->states($state, 'with_discussion')->create([
            'creator' => $owner->username,
            'user_id' => $owner->getKey(),
        ]);

        $modes = $this->beatmapset->beatmaps->map->mode->all();
        $nominatorCount = config('osu.beatmapset.required_nominations');

        $this->nominators = [];

        for ($i = 0; $i < $nominatorCount; $i++) {
            $this->nominators[] = $nominator = $this->createUserWithGroupPlaymodes('bng', $modes);
            factory(BeatmapsetNomination::class)->create([
                'beatmapset_id' => $this->beatmapset->getKey(),
                'user_id' => $nominator->getKey(),
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
