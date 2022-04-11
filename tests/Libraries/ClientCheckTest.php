<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\ClientCheck;
use App\Models\Build;
use App\Models\User;
use Tests\TestCase;

class ClientCheckTest extends TestCase
{
    public function testFindBuild()
    {
        $user = User::factory()->withGroup('default')->create();
        $build = Build::factory()->create(['allow_ranking' => true]);

        $foundBuild = ClientCheck::findBuild($user, ['version_hash' => bin2hex($build->hash)]);

        $this->assertSame($build->getKey(), $foundBuild->getKey());
    }

    public function testFindBuildAsAdmin()
    {
        $user = User::factory()->withGroup('admin')->create();
        $build = Build::factory()->create(['allow_ranking' => true]);

        $foundBuild = ClientCheck::findBuild($user, ['version_hash' => bin2hex($build->hash)]);

        $this->assertSame($build->getKey(), $foundBuild->getKey());
    }

    public function testFindBuildDisallowedRanking()
    {
        $user = User::factory()->withGroup('default')->create();
        $build = Build::factory()->create(['allow_ranking' => false]);

        $this->expectExceptionMessage('invalid client hash');
        ClientCheck::findBuild($user, ['version_hash' => bin2hex($build->hash)]);
    }

    public function testFindBuildMissingParam()
    {
        $user = User::factory()->withGroup('default')->create();

        $this->expectExceptionMessage('missing client version');
        ClientCheck::findBuild($user, []);
    }

    public function testFindBuildNonexistent()
    {
        $user = User::factory()->withGroup('default')->create();

        $this->expectExceptionMessage('invalid client hash');
        ClientCheck::findBuild($user, ['version_hash' => 'stuff']);
    }

    public function testFindBuildNonexistentAsAdmin()
    {
        $user = User::factory()->withGroup('admin')->create();

        $foundBuild = ClientCheck::findBuild($user, ['version_hash' => 'stuff']);

        $this->assertNull($foundBuild);
    }

    public function testFindBuildNonexistentWithDisabledAssertion()
    {
        config()->set('osu.client.check_version', false);

        $user = User::factory()->withGroup('default')->create();

        $foundBuild = ClientCheck::findBuild($user, ['version_hash' => 'stuff']);

        $this->assertNull($foundBuild);
    }

    public function testFindBuildStringHash()
    {
        $user = User::factory()->withGroup('default')->create();
        $hashString = 'hello';
        $build = Build::factory()->create(['allow_ranking' => true, 'hash' => md5($hashString, true)]);

        $foundBuild = ClientCheck::findBuild($user, ['version_hash' => $hashString]);

        $this->assertSame($build->getKey(), $foundBuild->getKey());
    }
}
