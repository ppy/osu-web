<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests\Models;

use App\Exceptions\AuthorizationException;
use App\Models\Beatmap;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserGroup;
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

    public function testNominate()
    {
        $user = factory(User::class)->create();
        $beatmapset = $this->createBeatmapset();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $beatmapset->nominate($user);

        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($notifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isPending());
    }

    public function testQualify()
    {
        $user = factory(User::class)->create();
        $beatmapset = $this->createBeatmapset();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $beatmapset->qualify($user);

        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($notifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    public function testLimitedBNGQualifyingNominationBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLast($beatmapset, 'bng');

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
        $beatmapset->nominate($nominator);
        $this->assertTrue($beatmapset->isQualified());
    }

    public function testLimitedBNGQualifyingNominationNATNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLast($beatmapset, 'nat');

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
        $beatmapset->nominate($nominator);
        $this->assertTrue($beatmapset->isQualified());
    }

    public function testLimitedBNGQualifyingNominationLimitedBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLast($beatmapset, 'bng_limited');

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);

        $this->expectException(AuthorizationException::class);
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
        $userNotifications = UserNotification::count();

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
        $userNotifications = UserNotification::count();

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

    private function createBeatmapset($params = []) : Beatmapset
    {
        $defaultParams = [
            'discussion_enabled' => true,
            'approved' => Beatmapset::STATES['pending'],
            'download_disabled' => true,
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

    /**
     * Fills a beatmpaset's nominations until one nomination left to qualify.
     *
     * @param Beatmapset $beatmapset Beatmapset to fill the nominations for.
     * @param string $group A least one nomination will be by a user from this group.
     *
     * @return void
     */
    private function fillNominationsExceptLast(Beatmapset $beatmapset, string $group)
    {
        $user = factory(User::class)->create();
        $user->userGroups()->create(['group_id' => UserGroup::GROUPS[$group]]);
        $beatmapset->nominate($user);

        $count = $beatmapset->requiredNominationCount() - $beatmapset->currentNominationCount() - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate(factory(User::class)->create());
        }
    }
}
