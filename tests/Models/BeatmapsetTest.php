<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tests\Models;

use App\Exceptions\AuthorizationException;
use App\Models\Beatmap;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
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
        $nominator->userGroups()->create(['group_id' => app('groups')->byIdentifier('bng_limited')->getKey()]);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
        $beatmapset->nominate($nominator);
        $this->assertTrue($beatmapset->isQualified());
    }

    public function testLimitedBNGQualifyingNominationNATNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLast($beatmapset, 'nat');

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => app('groups')->byIdentifier('bng_limited')->getKey()]);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
        $beatmapset->nominate($nominator);
        $this->assertTrue($beatmapset->isQualified());
    }

    public function testLimitedBNGQualifyingNominationLimitedBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $this->fillNominationsExceptLast($beatmapset, 'bng_limited');

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => app('groups')->byIdentifier('bng_limited')->getKey()]);

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

    private function createBeatmapset($params = []): Beatmapset
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
        $user->userGroups()->create(['group_id' => app('groups')->byIdentifier($group)->getKey()]);
        $beatmapset->nominate($user);

        $count = $beatmapset->requiredNominationCount() - $beatmapset->currentNominationCount() - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate(factory(User::class)->create());
        }
    }
}
