<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserCompactTransformerTest extends TestCase
{
    public function testFriendsIsNotVisibleWithOAuth()
    {
        $viewer = $this->createUserWithGroup([]);

        $this->actAsScopedUser($viewer, Passport::scopes()->pluck('id')->all());

        $json = json_item($viewer, 'UserCompact', ['friends']);
        $this->assertArrayNotHasKey('friends', $json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsUserSilenceShowExtendedInfo($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $user = factory(User::class)->states('restricted', 'silenced', 'with_note')->create();

        $this->assertSame(3, $user->accountHistories()->count());

        $this->actAsScopedUser($viewer);

        $json = json_item($user, 'UserCompact', ['account_history.actor', 'account_history.supporting_url']);

        $accountHistories = array_get($json, 'account_history');
        $silences = array_filter($accountHistories, function ($item) {
            return $item['type'] === 'silence';
        });
        $this->assertCount(1, $accountHistories);
        $this->assertSame($accountHistories, $silences);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsWithOAuth($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $user = factory(User::class)->states('silenced')->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($user, 'UserCompact', ['account_history.actor', 'account_history.supporting_url']);

        $accountHistory = array_get($json, 'account_history.0');
        $this->assertArrayNotHasKey('actor', $accountHistory);
        $this->assertArrayNotHasKey('supporting_url', $accountHistory);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $user = factory(User::class)->states('silenced')->create();
        $this->actAsUser($viewer);

        $json = json_item($user, 'UserCompact', ['account_history.actor', 'account_history.supporting_url']);

        $accountHistory = array_get($json, 'account_history.0');
        if ($visible) {
            $this->assertArrayHasKey('actor', $accountHistory);
            $this->assertArrayHasKey('supporting_url', $accountHistory);
        } else {
            $this->assertArrayNotHasKey('actor', $accountHistory);
            $this->assertArrayNotHasKey('supporting_url', $accountHistory);
        }
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', false],
            ['gmt', false],
            ['nat', false],
            [[], false],
            [null, false],
        ];
    }
}
