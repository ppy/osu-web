<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Tests\TestCase;

class UserCompactTransformerTest extends TestCase
{
    /**
     * @dataProvider regularOAuthScopesDataProvider
     */
    public function testFriendsIsNotVisibleWithOAuth($scopes)
    {
        $viewer = User::factory()->create();

        $this->actAsScopedUser($viewer, [$scopes]);

        $json = json_item($viewer, 'UserCompact', ['friends']);
        $this->assertArrayNotHasKey('friends', $json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsUserSilenceShowExtendedInfo(?string $groupIdentifier)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $user = User::factory()->restricted()->silenced()->withNote()->create();

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
    public function testGroupPermissionsWithOAuth(?string $groupIdentifier)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $user = User::factory()->silenced()->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($user, 'UserCompact', ['account_history.actor', 'account_history.supporting_url']);

        $accountHistory = array_get($json, 'account_history.0');
        $this->assertArrayNotHasKey('actor', $accountHistory);
        $this->assertArrayNotHasKey('supporting_url', $accountHistory);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsWithoutOAuth(?string $groupIdentifier, bool $visible)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $user = User::factory()->silenced()->create();
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

    /**
     * @dataProvider propertyPermissionsDataProvider
     */
    public function testPropertyIsNotVisibleWithOAuth(string $property)
    {
        $viewer = User::factory()->create();

        $this->actAsScopedUser($viewer);

        $json = json_item($viewer, 'User', [$property]);
        $this->assertArrayNotHasKey($property, $json);
    }

    /**
     * @dataProvider propertyPermissionsDataProvider
     */
    public function testPropertyIsVisibleWithoutOAuth(string $property)
    {
        $viewer = User::factory()->create();

        $this->actAsUser($viewer);

        $json = json_item($viewer, 'User', [$property]);
        $this->assertArrayHasKey($property, $json);
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', false],
            ['gmt', false],
            ['nat', false],
            [null, false],
        ];
    }

    public function propertyPermissionsDataProvider()
    {
        $data = [];
        $transformer = new UserTransformer();
        foreach ($transformer->getPermissions() as $property => $permission) {
            if ($permission === 'IsNotOAuth') {
                $data[] = [$property];
            }
        }

        return $data;
    }
}
