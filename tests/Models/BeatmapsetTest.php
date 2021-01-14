<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Exceptions\AuthorizationException;
use App\Models\Beatmap;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Tests\TestCase;

class BeatmapsetTest extends TestCase
{
    public function testLove()
    {
        $user = factory(User::class)->create();
        $beatmapset = $this->createBeatmapset();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
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
        $user = $this->createGroupUserWithPlaymodes('bng', $beatmapset->playmodesStr());

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
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
        $user = $this->createGroupUserWithPlaymodes('bng', $beatmapset->playmodesStr());

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
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

        $nominator = $this->createGroupUserWithPlaymodes('bng_limited', $beatmapset->playmodesStr());

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();

        $result = $beatmapset->nominate($nominator, [$beatmapset->playmodesStr()[0]]);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testLimitedBNGQualifyingNominationNATNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLastForMode($beatmapset, 'nat', $beatmapset->playmodesStr()[0]);

        $nominator = $this->createGroupUserWithPlaymodes('bng_limited', $beatmapset->playmodesStr());

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();

        $result = $beatmapset->nominate($nominator, [$beatmapset->playmodesStr()[0]]);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testLimitedBNGQualifyingNominationLimitedBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', $beatmapset->playmodesStr()[0]);

        $nominator = $this->createGroupUserWithPlaymodes('bng_limited', $beatmapset->playmodesStr());

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
        $nominator = $this->createGroupUserWithPlaymodes('bng', $beatmapset->playmodesStr());

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage(trans('authorization.beatmap_discussion.nominate.set_metadata'));
        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
    }

    public function testRank()
    {
        $otherUser = factory(User::class)->create();

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

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $res = $beatmapset->rank();

        $this->assertFalse($res);
        $this->assertFalse($beatmapset->fresh()->isRanked());
        $this->assertSame($notifications, UserNotification::count());
        $this->assertSame($notifications, Notification::count());
    }

    public function testGlobalScopeActive()
    {
        $beatmapset = factory(Beatmapset::class)->states('inactive')->create();
        $id = $beatmapset->getKey();

        $this->assertNull(Beatmapset::find($id)); // global scope
        $this->assertNull(Beatmapset::withoutGlobalScopes()->active()->find($id)); // scope still applies after removing global scope
        $this->assertTrue($beatmapset->is(Beatmapset::withoutGlobalScopes()->find($id))); // no global scopes
    }

    public function testGlobalScopeSoftDelete()
    {
        $beatmapset = factory(Beatmapset::class)->states(['inactive', 'deleted'])->create();
        $id = $beatmapset->getKey();

        $this->assertNull(Beatmapset::withTrashed()->find($id));
    }

    // endregion

    // region multi-playmode beatmap sets (aka hybrid)
    public function testHybridLegacyNominate(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu']);
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        // create legacy nomination event to enable legacy nomination mode
        $beatmapset->events()->create([
            'type' => BeatmapsetEvent::NOMINATE,
            'user_id' => $this->createGroupUserWithPlaymodes('bng', $beatmapset->playmodesStr())->getKey(),
        ]);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridLegacyQualify(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu']);
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        // create legacy nomination event to enable legacy nomination mode
        $beatmapset->events()->create([
            'type' => BeatmapsetEvent::NOMINATE,
            'user_id' => $this->createGroupUserWithPlaymodes('bng', $beatmapset->playmodesStr())->getKey(),
        ]);

        // fill with legacy nominations
        $count = $beatmapset->requiredNominationCount() - $beatmapset->currentNominationCount() - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate($this->createGroupUserWithPlaymodes('bng', ['osu']));
        }

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testHybridNominateWithNullPlaymode(): void
    {
        $user = factory(User::class)->create();
        $beatmapset = $this->createHybridBeatmapset();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], trans('beatmapsets.nominate.hybrid_requires_modes'));

        $this->assertSame($notifications, Notification::count());
        $this->assertSame($userNotifications, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithNoPlaymodePermission(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu']);
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, ['taiko']);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], trans('beatmapsets.nominate.incorrect_mode', ['mode' => 'taiko']));

        $this->assertSame($notifications, Notification::count());
        $this->assertSame($userNotifications, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithPlaymodePermissionSingleMode(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu']);
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, ['osu']);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithPlaymodePermissionTooMany(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu']);
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'osu');

        $result = $beatmapset->nominate($this->createGroupUserWithPlaymodes('bng', ['osu']), ['osu']);
        $this->assertTrue($result['result']);

        $result = $beatmapset->fresh()->nominate($user, ['osu']);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], trans('beatmaps.nominations.too_many'));
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominateWithPlaymodePermissionMultipleModes(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu', 'taiko']);
        $beatmapset = $this->createHybridBeatmapset(null, ['osu', 'taiko']);

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $result = $beatmapset->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($result['result']);
        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($userNotifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominationBNGQualifyingBNGNominatedPartial(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng_limited', ['osu', 'taiko']);
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'taiko');

        $result = $beatmapset->nominate($user, ['osu']);

        $this->assertTrue($result['result']);
        $this->assertFalse($beatmapset->fresh()->isQualified());
    }

    public function testHybridNominationLimitedBNGQualifyingLimitedBNGNominated(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng_limited', ['osu', 'taiko']);
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'taiko');

        $result = $beatmapset->fresh()->nominate($user, ['osu', 'taiko']);

        $this->assertFalse($result['result']);
        $this->assertSame($result['message'], trans('beatmapsets.nominate.full_bn_required'));
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testHybridNominationLimitedBNGQualifyingBNGNominated(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng', ['osu', 'taiko']);
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng_limited', 'taiko');

        $result = $beatmapset->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testHybridNominationBNGQualifyingLimitedBNGNominated(): void
    {
        $user = $this->createGroupUserWithPlaymodes('bng_limited', ['osu', 'taiko']);
        $beatmapset = $this->createHybridBeatmapset();

        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'osu');
        $this->fillNominationsExceptLastForMode($beatmapset, 'bng', 'taiko');

        $result = $beatmapset->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($result['result']);
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    //end region

    private function createBeatmapset($params = []): Beatmapset
    {
        $defaultParams = [
            'discussion_enabled' => true,
            'approved' => Beatmapset::STATES['pending'],
            'download_disabled' => true,
            'genre_id' => $this->fakeGenre->genre_id,
            'language_id' => $this->fakeLanguage->language_id,
        ];

        if (!isset($params['user_id'])) {
            $user = factory(User::class)->create();

            $params['user_id'] = $user->getKey();
        }

        $beatmapset = factory(Beatmapset::class)->create(array_merge($defaultParams, $params));
        $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

        return $beatmapset;
    }

    private function createHybridBeatmapset($params = [], $playmodes = ['osu', 'taiko']): Beatmapset
    {
        $defaultParams = [
            'discussion_enabled' => true,
            'approved' => Beatmapset::STATES['pending'],
            'download_disabled' => true,
            'genre_id' => $this->fakeGenre->genre_id,
            'language_id' => $this->fakeLanguage->language_id,
        ];

        if (!isset($params['user_id'])) {
            $user = factory(User::class)->create();

            $params['user_id'] = $user->getKey();
        }

        $beatmapset = factory(Beatmapset::class)->create(array_merge($defaultParams, $params));

        foreach ($playmodes as $playmode) {
            $beatmapset->beatmaps()->save(factory(Beatmap::class)->make(['playmode' => Beatmap::modeInt($playmode)]));
        }
        factory(BeatmapMirror::class)->states('default')->create();

        return $beatmapset;
    }

    private function createGroupUserWithPlaymodes($group = 'bng', $playmodes = ['osu'])
    {
        app('groups')->byIdentifier($group)->update(['has_playmodes' => true]);
        app('groups')->resetCache();
        $user = factory(User::class)->create();
        $user->userGroups()->create([
            'group_id' => app('groups')->byIdentifier($group)->getKey(),
            'playmodes' => $playmodes,
            'user_pending' => 0,
        ]);

        return $user;
    }

    private function fillNominationsExceptLastForMode(Beatmapset $beatmapset, string $group, string $playmode): void
    {
        $count = $beatmapset->requiredNominationCount()[$playmode] - $beatmapset->currentNominationCount()[$playmode] - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate($this->createGroupUserWithPlaymodes($group, [$playmode]), [$playmode]);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        factory(Genre::class)->create(['genre_id' => Genre::UNSPECIFIED]);
        factory(Language::class)->create(['language_id' => Language::UNSPECIFIED]);
        $this->fakeGenre = factory(Genre::class)->create();
        $this->fakeLanguage = factory(Language::class)->create();
    }
}
