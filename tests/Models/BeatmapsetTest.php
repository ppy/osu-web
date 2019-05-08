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
use App\Exceptions\AuthorizationException;
use App\Models\Beatmap;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserNotification;

class BeatmapsetTest extends TestCase
{
    public function testLove()
    {
        $user = factory(User::class)->create();
        $beatmapset = $this->createBeatmapset();
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

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
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

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
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

        $notifications = Notification::count();
        $userNotifications = UserNotification::count();

        $otherUser = factory(User::class)->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $beatmapset->qualify($user);

        $this->assertSame($notifications + 1, Notification::count());
        $this->assertSame($notifications + 1, UserNotification::count());
        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testLimitedBNGNominatingBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

        $user = factory(User::class)->create();
        $user->userGroups()->create(['group_id' => UserGroup::GROUPS['bng']]);
        $beatmapset->nominate($user);

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testLimitedBNGNominatingNATNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

        $user = factory(User::class)->create();
        $user->userGroups()->create(['group_id' => UserGroup::GROUPS['nat']]);
        $beatmapset->nominate($user);

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
    }

    public function testLimitedBNGNominatingLimitedBNGNominated()
    {
        $beatmapset = $this->createBeatmapset();
        $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        factory(BeatmapMirror::class)->states('default')->create();

        $user = factory(User::class)->create();
        $user->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);
        $beatmapset->nominate($user);

        $nominator = factory(User::class)->create();
        $nominator->userGroups()->create(['group_id' => UserGroup::GROUPS['bng_limited']]);

        $this->expectException(AuthorizationException::class);
        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
    }

    private function createBeatmapset($params = [])
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

        return factory(Beatmapset::class)->create(array_merge($defaultParams, $params));
    }
}
