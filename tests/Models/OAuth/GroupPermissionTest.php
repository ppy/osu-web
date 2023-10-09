<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\OAuth;

use App\Models\User;
use Tests\TestCase;

class GroupPermissionTest extends TestCase
{
    /**
     * @dataProvider booleanDataProvider
     */
    public function testIsBot(bool $useOAuth): void
    {
        $user = User::factory()->withGroup('bot')->create();

        if ($useOAuth) {
            $this->actAsScopedUser($user, ['public']);
        } else {
            $this->actAsUser($user);
        }

        $this->assertTrue(auth()->user()->isBot());
    }

    /**
     * @dataProvider booleanDataProvider
     */
    public function testIsGroupWithOAuth(bool $allowOAuth): void
    {
        $group = 'test_group';

        $this->actAsScopedUser(
            User::factory()->withGroup($group)->create(),
            ['public'],
        );

        $this->assertSame(
            $allowOAuth,
            auth()->user()->isGroup($group, allowOAuth: $allowOAuth),
        );
    }

    /**
     * @dataProvider booleanDataProvider
     */
    public function testIsGroupWithoutOAuth(bool $allowOAuth): void
    {
        $group = 'test_group';

        $this->actAsUser(User::factory()->withGroup($group)->create());

        $this->assertTrue(auth()->user()->isGroup($group, allowOAuth: $allowOAuth));
    }

    public function booleanDataProvider(): array
    {
        return [[true], [false]];
    }
}
