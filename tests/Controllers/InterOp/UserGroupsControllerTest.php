<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp;

use App\Models\Group;
use App\Models\User;
use App\Models\UserGroupEvent;
use Tests\TestCase;

class UserGroupsControllerTest extends TestCase
{
    public function testUserGroupAdd()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $user->refresh();

        $this->assertTrue($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount + 1,
        );
    }

    public function testUserGroupAddWhenAlreadyMember()
    {
        $user = $this->createUserWithGroup('gmt');
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $this->assertTrue($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount,
        );
    }

    public function testUserGroupAddWhenHasSameModes()
    {
        $modes = ['osu'];
        $user = $this->createUserWithGroupModes('nat', $modes);
        $group = app('groups')->byIdentifier('nat');
        $userAddModesEventCount = $this->eventCount(UserGroupEvent::USER_ADD_MODES, $user, $group);
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'modes' => $modes,
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD_MODES, $user, $group),
            $userAddModesEventCount,
        );
    }

    public function testUserGroupChangeModes()
    {
        $modes = ['fruits', 'mania'];
        $user = $this->createUserWithGroupModes('nat', ['osu', 'taiko']);
        $group = app('groups')->byIdentifier('nat');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userAddModesEventCount = $this->eventCount(UserGroupEvent::USER_ADD_MODES, $user, $group);
        $userRemoveModesEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE_MODES, $user, $group);
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'modes' => $modes,
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $res = $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $actualModes = $this->getUserGroupModes($user, $group);

        $this->assertCount(count($modes), $actualModes);
        $this->assertArraySubset($modes, $actualModes);
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount,
        );
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD_MODES, $user, $group),
            $userAddModesEventCount + 1,
        );
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_REMOVE_MODES, $user, $group),
            $userRemoveModesEventCount + 1,
        );
    }

    public function testUserGroupRemove()
    {
        $user = $this->createUserWithGroup('gmt');
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group);
        $url = route('interop.user-groups.destroy', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->delete($url)
            ->assertStatus(204);

        $user->refresh();

        $this->assertNotSame($user->group_id, $group->getKey());
        $this->assertFalse($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group),
            $userRemoveEventCount + 1,
        );
    }

    public function testUserGroupRemoveWhenNotMember()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group);
        $url = route('interop.user-groups.destroy', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->delete($url)
            ->assertStatus(204);

        $this->assertFalse($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group),
            $userRemoveEventCount,
        );
    }

    public function testUserGroupSetDefault()
    {
        $user = $this->createUserWithGroup('gmt', ['group_id' => app('groups')->byIdentifier('default')->getKey()]);
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userSetDefaultEventCount = $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group);
        $url = route('interop.user-groups.store-default', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $user->refresh();

        $this->assertSame($user->group_id, $group->getKey());
        $this->assertTrue($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount,
        );
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group),
            $userSetDefaultEventCount + 1,
        );
    }

    public function testUserGroupSetDefaultLeavesModesUnchanged()
    {
        $modes = ['osu'];
        $user = $this->createUserWithGroupModes('nat', $modes, false);
        $group = app('groups')->byIdentifier('nat');
        $url = route('interop.user-groups.store-default', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $user->refresh();

        $actualModes = $this->getUserGroupModes($user, $group);

        $this->assertCount(count($modes), $actualModes);
        $this->assertArraySubset($modes, $actualModes);
    }

    public function testUserGroupSetDefaultWhenNotMember()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userSetDefaultEventCount = $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group);
        $url = route('interop.user-groups.store-default', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $user->refresh();

        $this->assertSame($user->group_id, $group->getKey());
        $this->assertTrue($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount + 1,
        );
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group),
            $userSetDefaultEventCount + 1,
        );
    }

    public function testInvalidModes()
    {
        $user = factory(User::class)->create();
        $group = $this->getGroupWithModes('nat');
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'modes' => ['osu', 'invalid_mode'],
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(422);
    }

    public function testMissingUserOrGroup()
    {
        $url = route('interop.user-groups.store', [
            'timestamp' => time(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(404);
    }

    public function testModesWithoutGroupModesSet()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'modes' => ['osu'],
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(422);
    }

    private function createUserWithGroupModes(string $identifier, array $modes, bool $defaultGroup = true): User
    {
        $user = factory(User::class)->create();
        $groupId = $this->getGroupWithModes($identifier)->getKey();

        $user->userGroups()->create([
            'group_id' => $groupId,
            'playmodes' => $modes,
            'user_pending' => false,
        ]);

        if ($defaultGroup) {
            $user->update(['group_id' => $groupId]);
        }

        return $user;
    }

    private function eventCount(string $type, User $user, Group $group): int
    {
        return UserGroupEvent
            ::where([
                'group_id' => $group->getKey(),
                'type' => $type,
                'user_id' => $user->getKey(),
            ])
            ->count();
    }

    private function getGroupWithModes(string $identifier): Group
    {
        $group = app('groups')->byIdentifier($identifier);

        $group->update(['has_playmodes' => true]);
        app('groups')->resetCache();

        return $group;
    }

    private function getUserGroupModes(User $user, Group $group): ?array
    {
        return optional(
            $user
                ->userGroups()
                ->where('group_id', $group->getKey())
                ->first()
        )
            ->playmodes;
    }
}
