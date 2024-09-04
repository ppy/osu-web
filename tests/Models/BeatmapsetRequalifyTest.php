<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Jobs\CheckBeatmapsetCovers;
use App\Libraries\BeatmapsetDiscussion\Reply;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;
use Bus;
use Carbon\CarbonImmutable;
use Database\Factories\BeatmapsetFactory;
use Tests\TestCase;

class BeatmapsetRequalifyTest extends TestCase
{
    private const DISQUALIFIED_INTERVAL = 86400;

    public function testDoesNotResetQueue()
    {
        $disqualifiedDate = CarbonImmutable::now()->subDays(1);
        $qualifiedDate = $disqualifiedDate->subSeconds(static::DISQUALIFIED_INTERVAL)->startOfSecond();
        $user = User::factory()->withGroup('bng')->create()->markSessionVerified();

        $this->travelTo($qualifiedDate);

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->withBeatmaps('osu')
            ->withNominations()
            ->create();

        $nominators = $beatmapset->beatmapsetNominations()->get()->pluck('user');

        // sanity
        $this->assertNull($beatmapset->previous_queue_duration);
        $this->assertEquals($qualifiedDate, $beatmapset->approved_date);

        $this->travelTo($disqualifiedDate);

        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();
        // TODO: timing issues 86401 != 86400
        $this->assertSame(static::DISQUALIFIED_INTERVAL, $beatmapset->previous_queue_duration);
        $this->assertNull($beatmapset->queued_at);

        $this->travelBack();

        $this->resolveDiscussionAndNominate($discussion, $user, $nominators);
        $beatmapset = $beatmapset->fresh();

        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals($beatmapset->approved_date->toImmutable()->subSeconds(static::DISQUALIFIED_INTERVAL), $beatmapset->queued_at);
    }

    public function testDifferentNominatorResetsQueue()
    {
        $disqualifiedDate = CarbonImmutable::now()->subDays(1);
        $qualifiedDate = $disqualifiedDate->subSeconds(static::DISQUALIFIED_INTERVAL)->startOfSecond();
        $user = User::factory()->withGroup('bng', ['osu'])->create()->markSessionVerified();

        $this->travelTo($qualifiedDate);

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->withBeatmaps('osu')
            ->withNominations()
            ->create();

        $nominators = $beatmapset->beatmapsetNominations()->get()->pluck('user');
        // replace 1 nominator with a different one.
        $nominators[0] = $user;

        $this->travelTo($disqualifiedDate);

        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();

        $this->travelBack();

        $this->resolveDiscussionAndNominate($discussion, $user, $nominators);
        $beatmapset = $beatmapset->fresh();

        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals(CarbonImmutable::now()->startOfSecond(), $beatmapset->queued_at);
        $this->assertEquals($beatmapset->approved_date, $beatmapset->queued_at);
    }

    // tests nominators from previous qualification are considered as different nominators.
    public function testNominatorFromPriorQualificationResetsQueue()
    {
        $disqualifiedDate = CarbonImmutable::now()->subDays(1);
        $qualifiedDate = $disqualifiedDate->subSeconds(static::DISQUALIFIED_INTERVAL)->startOfSecond();
        $user = User::factory()->withGroup('bng', ['osu'])->create()->markSessionVerified();

        $this->travelTo($qualifiedDate);

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->withBeatmaps('osu')
            ->withNominations()
            ->create();

        $nominators = $beatmapset->beatmapsetNominations()->get()->pluck('user');

        $this->travelTo($disqualifiedDate);

        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();

        // second qualification
        $this->travelTo($disqualifiedDate->addSeconds(60));

        $newNominators = User::factory()->withGroup('nat')->count(config('osu.beatmapset.required_nominations'))->create();
        $this->resolveDiscussionAndNominate($discussion, $user, $newNominators);
        $beatmapset = $beatmapset->fresh();

        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals(CarbonImmutable::now()->startOfSecond(), $beatmapset->queued_at);
        $this->assertEquals($beatmapset->approved_date, $beatmapset->queued_at);

        // second disqualification
        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();
        $this->assertTrue($beatmapset->isPending());

        $this->travelBack();

        $this->resolveDiscussionAndNominate($discussion, $user, $nominators);
        $beatmapset = $beatmapset->fresh();

        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals(CarbonImmutable::now()->startOfSecond(), $beatmapset->queued_at);
        $this->assertEquals($beatmapset->approved_date, $beatmapset->queued_at);
    }

    public function testNominatorFromRecentQualificationDoesNotResetQueue()
    {
        $disqualifiedDate = CarbonImmutable::now()->subDays(1);
        $qualifiedDate = $disqualifiedDate->subSeconds(static::DISQUALIFIED_INTERVAL)->startOfSecond();
        $user = User::factory()->withGroup('bng', ['osu'])->create()->markSessionVerified();

        $this->travelTo($qualifiedDate);

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->withBeatmaps('osu')
            ->withNominations()
            ->create();

        $this->travelTo($disqualifiedDate);

        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();

        // second qualification
        $this->travelTo($disqualifiedDate->addSeconds(60));

        $newNominators = User::factory()->withGroup('nat')->count(config('osu.beatmapset.required_nominations'))->create();
        $this->resolveDiscussionAndNominate($discussion, $user, $newNominators);
        $beatmapset = $beatmapset->fresh();

        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals(CarbonImmutable::now()->startOfSecond(), $beatmapset->queued_at);
        $this->assertEquals($beatmapset->approved_date, $beatmapset->queued_at);
        $previousQueueDuration = $beatmapset->previous_queue_duration;

        // second disqualification
        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();
        $this->assertTrue($beatmapset->isPending());

        $this->travelBack();

        $this->resolveDiscussionAndNominate($discussion, $user, $newNominators);
        $beatmapset = $beatmapset->fresh();

        // queue should not reset.
        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals($previousQueueDuration, CarbonImmutable::now()->getTimestamp() - $beatmapset->queued_at->getTimestamp());
    }

    public function testNewDifficultyAddedResetsQueue()
    {
        $disqualifiedDate = CarbonImmutable::now()->subDays(1);
        $qualifiedDate = $disqualifiedDate->subSeconds(static::DISQUALIFIED_INTERVAL)->startOfSecond();
        $user = User::factory()->withGroup('bng', ['osu'])->create()->markSessionVerified();

        $this->travelTo($qualifiedDate);

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->withBeatmaps('osu')
            ->withNominations()
            ->create();

        $nominators = $beatmapset->beatmapsetNominations()->get()->pluck('user');

        $this->travelTo($disqualifiedDate);

        $discussion = $this->disqualifyOrResetNominations($beatmapset, $user);
        $beatmapset = $beatmapset->fresh();

        $this->travelBack();

        $beatmapset->beatmaps()->save(Beatmap::factory()->ruleset('osu')->make());

        $this->resolveDiscussionAndNominate($discussion, $user, $nominators);
        $beatmapset = $beatmapset->fresh();

        $this->assertTrue($beatmapset->isQualified());
        $this->assertEquals(CarbonImmutable::now()->startOfSecond(), $beatmapset->queued_at);
        $this->assertEquals($beatmapset->approved_date, $beatmapset->queued_at);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Genre::factory()->create(['genre_id' => Genre::UNSPECIFIED]);
        Language::factory()->create(['language_id' => Language::UNSPECIFIED]);

        Bus::fake([CheckBeatmapsetCovers::class]);
    }

    private function beatmapsetFactory(): BeatmapsetFactory
    {
        // otherwise they start as null without refresh.
        return Beatmapset::factory()->owner()->pending()->state(['nominations' => 0]);
    }

    private function disqualifyOrResetnominations(Beatmapset $beatmapset, User $user)
    {
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create(['beatmapset_id' => $beatmapset, 'user_id' => $user]);
        $beatmapset->disqualifyOrResetNominations($user, $discussion);

        return $discussion;
    }

    private function resolveDiscussionAndNominate(BeatmapDiscussion $discussion, User $user, iterable $nominators)
    {
        (new Reply($user, $discussion, 'resolve', true))->handle();
        $beatmapset = $discussion->fresh()->beatmapset;

        foreach ($nominators as $nominator) {
            $beatmapset->nominate($nominator, ['osu']);
        }
    }
}
