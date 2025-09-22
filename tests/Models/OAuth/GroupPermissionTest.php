<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Models\Forum\Forum;
use App\Models\OAuth\Client;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class GroupPermissionTest extends TestCase
{
    public static function dataProviderForTestGroup()
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

    public static function dataProviderForTestForumModerator()
    {
        return [
            ['admin', [], false],
            ['admin', ['gmt'], false],
            ['admin', ['admin', 'gmt'], true],

            ['loved', [], false],
            ['loved', ['admin', 'gmt'], false],
            ['loved', ['admin', 'gmt', 'loved'], true],

            ['gmt', [], false],
            ['gmt', ['loved'], false],
            ['gmt', ['gmt', 'loved'], true],
        ];
    }

    /**
     * TODO: maybe an exclusion list of when groups are allowed with token instead...
     */
    #[DataProvider('dataProviderForTestGroup')]
    public function testGroupWithOAuth(string $group, string $method, bool $inGroup)
    {
        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $token = $this->createToken($user, ['*'], $client);
        $this->actAsUserWithToken($token);

        $this->assertSame($inGroup, \Auth::user()->$method());
    }

    #[DataProvider('dataProviderForTestGroup')]
    public function testGroupWithoutOAuth(string $group, string $method)
    {
        $user = User::factory()->withGroup($group)->create();
        $this->actAsUser($user);

        $this->assertTrue(\Auth::user()->$method());
    }

    #[DataProvider('dataProviderForTestForumModerator')]
    public function testForumModeratorWithOAuth(string $group, array $forumGroups, bool $inGroup)
    {

        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $forum = Forum::factory()->moderatorGroups($forumGroups)->create();
        $token = $this->createToken($user, ['*'], $client);
        $this->actAsUserWithToken($token);

        $this->assertSame($inGroup, \Auth::user()->isForumModerator($forum));
    }

    #[DataProvider('dataProviderForTestForumModerator')]
    public function testForumModeratorWithoutOAuth(string $group, array $forumGroups, bool $inGroup)
    {
        $user = User::factory()->withGroup($group)->create();
        $forum = Forum::factory()->moderatorGroups($forumGroups)->create();
        $this->actAsUser($user);

        $this->assertSame($inGroup, \Auth::user()->isForumModerator($forum));
    }
}
