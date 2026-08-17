<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\User;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserTransformer;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UserCompactTransformerTest extends TestCase
{
    #[DataProvider('regularOAuthScopesDataProvider')]
    public function testFriendsIsNotVisibleWithOAuth($scopes)
    {
        $viewer = User::factory()->create();

        $this->actAsScopedUser($viewer, [$scopes]);

        $json = json_item($viewer, new UserCompactTransformer(), ['friends']);
        $this->assertArrayNotHasKey('friends', $json);
    }

    #[DataProvider('groupsDataProvider')]
    public function testGroupPermissionsUserSilenceShowExtendedInfo(?string $groupIdentifier)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $user = User::factory()->restricted()->silenced()->tournamentBanned()->withNote()->create();

        $this->assertSame(4, $user->accountHistories()->count());

        $this->actAsScopedUser($viewer);

        $json = json_item($user, new UserCompactTransformer(), ['account_history.actor', 'account_history.supporting_url']);

        $accountHistories = array_get($json, 'account_history');
        $publicInfringements = array_filter($accountHistories, function ($item) {
            return $item['type'] === 'silence' || $item['type'] === 'tournament_ban';
        });
        $this->assertCount(2, $accountHistories);
        $this->assertSame($accountHistories, $publicInfringements);
    }

    #[DataProvider('groupsDataProvider')]
    public function testGroupPermissionsWithOAuth(?string $groupIdentifier)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $user = User::factory()->silenced()->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($user, new UserCompactTransformer(), ['account_history.actor', 'account_history.supporting_url']);

        $accountHistory = array_get($json, 'account_history.0');
        $this->assertArrayNotHasKey('actor', $accountHistory);
        $this->assertArrayNotHasKey('supporting_url', $accountHistory);
    }

    #[DataProvider('groupsDataProvider')]
    public function testGroupPermissionsWithoutOAuth(?string $groupIdentifier, bool $visible)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $user = User::factory()->silenced()->create();
        $this->actAsUser($viewer);

        $json = json_item($user, new UserCompactTransformer(), ['account_history.actor', 'account_history.supporting_url']);

        $accountHistory = array_get($json, 'account_history.0');
        if ($visible) {
            $this->assertArrayHasKey('actor', $accountHistory);
            $this->assertArrayHasKey('supporting_url', $accountHistory);
        } else {
            $this->assertArrayNotHasKey('actor', $accountHistory);
            $this->assertArrayNotHasKey('supporting_url', $accountHistory);
        }
    }

    #[DataProvider('propertyPermissionsDataProvider')]
    public function testPropertyIsNotVisibleWithOAuth(string $property)
    {
        $viewer = User::factory()->create();

        $this->actAsScopedUser($viewer);

        $json = json_item($viewer, new UserTransformer(), [$property]);
        $this->assertArrayNotHasKey($property, $json);
    }

    #[DataProvider('propertyPermissionsDataProvider')]
    public function testPropertyIsVisibleWithoutOAuth(string $property)
    {
        $viewer = User::factory()->create();

        $this->actAsUser($viewer);

        $json = json_item($viewer, new UserTransformer(), [$property]);
        $this->assertArrayHasKey($property, $json);
    }

    public static function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', false],
            ['gmt', false],
            ['nat', false],
            [null, false],
        ];
    }

    public static function propertyPermissionsDataProvider()
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
