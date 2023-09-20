<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Models\OAuth\Client;
use App\Models\User;
use Tests\TestCase;

class GroupPermissionTest extends TestCase
{
    /**
     * TODO: maybe an exclusion list of when groups are allowed with token instead...
     *
     * @dataProvider groupsDataProvider
     *
     * @return void
     */
    public function testGroupWithOAuth(string $group, string $method, bool $inGroup)
    {
        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $token = $this->createToken($user, ['*'], $client);
        $this->actAsUserWithToken($token);

        $this->assertSame($inGroup, auth()->user()->$method());
    }

    /**
     * @dataProvider groupsDataProvider
     *
     * @return void
     */
    public function testGroupWithoutOAuth(string $group, string $method)
    {
        $user = User::factory()->withGroup($group)->create();
        $this->actAsUser($user);

        $this->assertTrue(auth()->user()->$method());
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', 'isAdmin', false],
            ['alumni', 'isAlumni', false],
            ['announce', 'isChatAnnouncer', true],
            ['bng', 'isBNG', false],
            ['bot', 'isBot', true],
            ['dev', 'isDev', false],
            ['gmt', 'isGMT', false],
            ['loved', 'isProjectLoved', false],
            ['nat', 'isNAT', false],
        ];
    }
}
