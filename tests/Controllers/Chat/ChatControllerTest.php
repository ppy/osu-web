<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use App\Models\User;
use App\Models\UserRelation;

class ChatControllerTest extends TestCase
{
    protected static $faker;

    public static function setUpBeforeClass()
    {
        self::$faker = Faker\Factory::create();
    }

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
    }

    //region POST /chat/new - Create New PM
    public function testCreatePMWhenGuest() // fail
    {
        $this->json(
            'POST',
            route('chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(401);
    }

    public function testCreatePMWhenBlocked() // fail
    {
        factory(UserRelation::class)->states('block')->create([
            'user_id' => $this->anotherUser->user_id,
            'zebra_id' => $this->user->user_id,
        ]);

        $this->actingAs($this->user)
            ->json(
                'POST',
                route('chat.new'),
                [
                    'target_id' => $this->anotherUser->user_id,
                    'message' => self::$faker->sentence(),
                ]
            )->assertStatus(403);
    }

    public function testCreatePMWhenFriendsOnlyAndNotFriended() // fail
    {
        $privateUser = factory(User::class)->create(['pm_friends_only' => true]);

        $this->actingAs($this->user)
            ->json(
                'POST',
                route('chat.new'),
                [
                    'target_id' => $privateUser->user_id,
                    'message' => self::$faker->sentence(),
                ]
            )->assertStatus(403);
    }

    public function testCreatePMWhenFriendsOnlyAndFriended() // success
    {
        $privateUser = factory(User::class)->create(['pm_friends_only' => true]);
        factory(UserRelation::class)->states('friend')->create([
            'user_id' => $privateUser->user_id,
            'zebra_id' => $this->user->user_id,
        ]);

        $this->actingAs($this->user)
            ->json(
                'POST',
                route('chat.new'),
                [
                    'target_id' => $privateUser->user_id,
                    'message' => self::$faker->sentence(),
                ]
            )->assertStatus(200);
    }

    public function testCreatePM() // success
    {
        $this->actingAs($this->user)
            ->json(
                'POST',
                route('chat.new'),
                [
                    'target_id' => $this->anotherUser->user_id,
                    'message' => self::$faker->sentence(),
                ]
            )->assertStatus(200);
    }

    public function testCreatePMWhenAlreadyExists() // fail?
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    //endregion

    //region GET /chat/updates?since=[message_id] - Get Updates
    public function testChatUpdatesWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChatUpdates() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    //endregion
}
