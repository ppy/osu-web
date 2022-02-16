<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Exceptions\AuthorizationException;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\BeatmapsetNomination;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Queue;
use Tests\TestCase;

class BeatmapsetTest extends TestCase
{
    public function testLove()
    {
        $user = User::factory()->create();
        $beatmapset = $this->createBeatmapset();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $beatmapset->love($user);

        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isLoved());
    }

    // region single-playmode beatmap sets
    public function testNominate()
    {
        $beatmapset = $this->createBeatmapset();
        $user = User::factory()->withGroup('bng', $beatmapset->playmodesStr())->create();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, [$beatmapset->playmodesStr()[0]]);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testQualify()
    {
        $beatmapset = $this->createBeatmapset();
        $user = User::factory()->withGroup('bng', $beatmapset->playmodesStr())->create();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $beatmapset->qualify($user);

        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testLimitedBNGQualifyingNominationBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', $beatmapset->playmodesStr()[0]);

        $nominator = User::factory()->withGroup('bng_limited', $beatmapset->playmodesStr())->create();

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();

        $result = $beatmapset->nominate($nominator, [$beatmapset->playmodesStr()[0]]);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testLimitedBNGQualifyingNominationNATNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLastForMode($beatmapset, 'nat', $beatmapset->playmodesStr()[0]);

        $nominator = User::factory()->withGroup('bng_limited', $beatmapset->playmodesStr())->create();

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();

        $result = $beatmapset->nominate($nominator, [$beatmapset->playmodesStr()[0]]);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testLimitedBNGQualifyingNominationLimitedBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', $beatmapset->playmodesStr()[0]);

        $nominator = User::factory()->withGroup('bng_limited', $beatmapset->playmodesStr())->create();

        $this->assertFalse($beatmapset->isQualified());
        $beatmapset->nominate($nominator);
        $this->assertFalse($beatmapset->isQualified());
    }
    public function testNominateWithDefaultMetadata()
    {
        $beatmapset = $this->createBeatmapset([
            'genre_id' => Genre::UNSPECIFIED,
            'language_id' => Language::UNSPECIFIED,
        ]);
        $nominator = User::factory()->withGroup('bng', $beatmapset->playmodesStr())->create();

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage(osu_trans('authorization.beatmap_discussion.nominate.set_metadata'));
        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
    }

    public function testRank()
    {
        $otherUser = User::factory()->create();

        $beatmapset = $this->createBeatmapset([
            'approved' => Beatmapset::STATES['qualified'],
        ]);

        $beatmap = $beatmapset->beatmaps()->first();
        $beatmap->scoresBest()->create([
            'user_id' => $otherUser->getKey(),
        ]);
        $scores = $beatmapset->beatmaps()->first()->scoresBest()->count();

        $notifications = Notification::count();

        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $beatmapset->rank();

        $this->assertTrue($beatmapset->fresh()->isRanked());
        $this->assertSame($notifications + 1, UserNotification::count());
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertNotSame(0, $scores);
        $this->assertSame(0, $beatmap->scoresBest()->count());
    }

    public function testRankFromWrongState()
    {
        $beatmapset = $this->createBeatmapset([
            'approved' => Beatmapset::STATES['pending'],
        ]);

        $notifications = Notification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $res = $beatmapset->rank();

        $this->assertFalse($res);
        $this->assertFalse($beatmapset->fresh()->isRanked());
        $this->assertSame($notifications, UserNotification::count());
        $this->assertSame($notifications, Notification::count());
    }

    public function testGlobalScopeActive()
    {
        $beatmapset = Beatmapset::factory()->inactive()->create();
        $id = $beatmapset->getKey();

        $this->assertNull(Beatmapset::find($id)); // global scope
        $this->assertNull(Beatmapset::withoutGlobalScopes()->active()->find($id)); // scope still applies after removing global scope
        $this->assertTrue($beatmapset->is(Beatmapset::withoutGlobalScopes()->find($id))); // no global scopes
    }

    public function testGlobalScopeSoftDelete()
    {
        $beatmapset = Beatmapset::factory()->inactive()->deleted()->create();
        $id = $beatmapset->getKey();

        $this->assertNull(Beatmapset::withTrashed()->find($id));
    }

    // endregion

    // region multi-playmode beatmap sets (aka hybrid)
    public function testHybridLegacyNominate(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        // create legacy nomination event to enable legacy nomination mode
        BeatmapsetNomination::factory()->create([
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory()->withGroup('bng', $beatmapset->playmodesStr()),
        ]);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridLegacyQualify(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        // create legacy nomination event to enable legacy nomination mode
        BeatmapsetNomination::factory()->create([
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory()->withGroup('bng', $beatmapset->playmodesStr()),
        ]);

        // fill with legacy nominations
        $count = $beatmapset->requiredNominationCount() - $beatmapset->currentNominationCount() - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate(User::factory()->withGroup('bng', ['osu'])->create());
        }

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testHybridNominateWithNullPlaymode(): void
    {
        $user = User::factory()->create();
        $beatmapset = $this->createHybridBeatmapset();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], osu_trans('beatmapsets.nominate.hybrid_requires_modes'));

        $this->assertSame($notifications, Notification::count());
        $this->assertSame($userNotifications, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithNoPlaymodePermission(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, ['taiko']);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], osu_trans('beatmapsets.nominate.incorrect_mode', ['mode' => 'taiko']));

        $this->assertSame($notifications, Notification::count());
        $this->assertSame($userNotifications, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithPlaymodePermissionSingleMode(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, ['osu']);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithPlaymodePermissionTooMany(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'osu');

        $result = $beatmapset->nominate(User::factory()->withGroup('bng', ['osu'])->create(), ['osu']);
        $this->assertTrue($result['result']);

        $result = $beatmapset->fresh()->nominate($user, ['osu']);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], osu_trans('beatmaps.nominations.too_many'));
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithPlaymodePermissionMultipleModes(): void
    {
        $user = User::factory()->withGroup('bng', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominationBNGQualifyingBNGNominatedPartial(): void
    {
        $user = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'taiko');

        $result = $beatmapset->nominate($user, ['osu']);

        $this->assertTrue($result['result']);
        $this->assertFalse($beatmapset->fresh()->isQualified());
    }

    public function testHybridNominationLimitedBNGQualifyingLimitedBNGNominated(): void
    {
        $user = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'taiko');

        $result = $beatmapset->fresh()->nominate($user, ['osu', 'taiko']);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], osu_trans('beatmapsets.nominate.full_bn_required'));
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominationLimitedBNGQualifyingBNGNominated(): void
    {
        $user = User::factory()->withGroup('bng', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'taiko');

        $result = $beatmapset->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testHybridNominationBNGQualifyingLimitedBNGNominated(): void
    {
        $user = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'taiko');

        $result = $beatmapset->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    //end region

    // region disqualification

    /**
     * @dataProvider disqualifyOrResetNominationsDataProvider
     */
    public function testDisqualifyOrResetNominations(string $state, string $pushed)
    {
        $user = User::factory()->withGroup('bng')->create();
        $beatmapset = Beatmapset::factory()->owner()->withDiscussion()->$state()->create();
        $discussion = $beatmapset->beatmapDiscussions()->first(); // contents only needed for logging.

        Queue::fake();

        $beatmapset->disqualifyOrResetNominations($user, $discussion);

        Queue::assertPushed($pushed);
    }

    //end region

    public function disqualifyOrResetNominationsDataProvider()
    {
        return [
            ['pending', BeatmapsetResetNominations::class],
            ['qualified', BeatmapsetDisqualify::class],
        ];
    }

    private function createBeatmapset($params = []): Beatmapset
    {
        $defaultParams = [
            'approved' => Beatmapset::STATES['pending'],
            'download_disabled' => true,
            'genre_id' => $this->fakeGenre->genre_id,
            'language_id' => $this->fakeLanguage->language_id,
        ];

        $params['user_id'] ??= User::factory();

        $beatmapset = Beatmapset::factory()->create(array_merge($defaultParams, $params));
        $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        factory(BeatmapMirror::class)->states('default')->create();

        return $beatmapset;
    }

    private function createHybridBeatmapset($params = [], $playmodes = ['osu', 'taiko']): Beatmapset
    {
        $defaultParams = [
            'approved' => Beatmapset::STATES['pending'],
            'download_disabled' => true,
            'genre_id' => $this->fakeGenre->genre_id,
            'language_id' => $this->fakeLanguage->language_id,
        ];

        $params['user_id'] ??= User::factory();

        $beatmapset = Beatmapset::factory()->create(array_merge($defaultParams, $params));

        foreach ($playmodes as $playmode) {
            $beatmapset->beatmaps()->save(Beatmap::factory()->make(['playmode' => Beatmap::modeInt($playmode)]));
        }
        factory(BeatmapMirror::class)->states('default')->create();

        return $beatmapset;
    }

    private function fillNominationsExceptLastForMode(Beatmapset $beatmapset, string $group, string $playmode): void
    {
        $count = $beatmapset->requiredNominationCount()[$playmode] - $beatmapset->currentNominationCount()[$playmode] - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate(User::factory()->withGroup($group, [$playmode])->create(), [$playmode]);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        Genre::factory()->create(['genre_id' => Genre::UNSPECIFIED]);
        Language::factory()->create(['language_id' => Language::UNSPECIFIED]);
        $this->fakeGenre = Genre::factory()->create();
        $this->fakeLanguage = Language::factory()->create();
    }
}
