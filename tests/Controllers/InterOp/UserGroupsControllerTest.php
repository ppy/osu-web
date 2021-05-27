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
        $url = route('interop.user-group.update', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
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
        $url = route('interop.user-group.update', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(204);

        $this->assertTrue($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount,
        );
    }

    public function testUserGroupAddWhenHasSamePlaymodes()
    {
        $playmodes = ['osu'];
        $user = $this->createUserWithGroupPlaymodes('nat', $playmodes);
        $group = app('groups')->byIdentifier('nat');
        $userAddPlaymodesEventCount = $this->eventCount(UserGroupEvent::USER_ADD_PLAYMODES, $user, $group);
        $url = route('interop.user-group.update', [
            'group_id' => $group->getKey(),
            'playmodes' => $playmodes,
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(204);

        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD_PLAYMODES, $user, $group),
            $userAddPlaymodesEventCount,
        );
    }

    public function testUserGroupChangePlaymodes()
    {
        $playmodes = ['fruits', 'mania'];
        $user = $this->createUserWithGroupPlaymodes('nat', ['osu', 'taiko']);
        $group = app('groups')->byIdentifier('nat');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userAddPlaymodesEventCount = $this->eventCount(UserGroupEvent::USER_ADD_PLAYMODES, $user, $group);
        $userRemovePlaymodesEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE_PLAYMODES, $user, $group);
        $url = route('interop.user-group.update', [
            'group_id' => $group->getKey(),
            'playmodes' => $playmodes,
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(204);

        $actualPlaymodes = $this->getUserGroupPlaymodes($user, $group);

        $this->assertCount(count($playmodes), $actualPlaymodes);
        $this->assertArraySubset($playmodes, $actualPlaymodes);
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount,
        );
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD_PLAYMODES, $user, $group),
            $userAddPlaymodesEventCount + 1,
        );
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_REMOVE_PLAYMODES, $user, $group),
            $userRemovePlaymodesEventCount + 1,
        );
    }

    public function testUserGroupRemove()
    {
        $user = $this->createUserWithGroup('gmt');
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group);
        $url = route('interop.user-group.destroy', [
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
        $url = route('interop.user-group.destroy', [
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
        $url = route('interop.user-group.set-default', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
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

    public function testUserGroupSetDefaultLeavesPlaymodesUnchanged()
    {
        $playmodes = ['osu'];
        $user = $this->createUserWithGroupPlaymodes('nat', $playmodes, false);
        $group = app('groups')->byIdentifier('nat');
        $url = route('interop.user-group.set-default', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(204);

        $user->refresh();

        $actualPlaymodes = $this->getUserGroupPlaymodes($user, $group);

        $this->assertCount(count($playmodes), $actualPlaymodes);
        $this->assertArraySubset($playmodes, $actualPlaymodes);
    }

    public function testUserGroupSetDefaultWhenNotMember()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userSetDefaultEventCount = $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group);
        $url = route('interop.user-group.set-default', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
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

    public function testInvalidPlaymodes()
    {
        $user = factory(User::class)->create();
        $group = $this->getGroupWithPlaymodes('nat');
        $url = route('interop.user-group.update', [
            'group_id' => $group->getKey(),
            'playmodes' => ['osu', 'invalid_playmode'],
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(422);
    }

    public function testMissingUserOrGroup()
    {
        $url = route('interop.user-group.update', [
            'timestamp' => time(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(404);
    }

    public function testPlaymodesWithoutGroupPlaymodesSet()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $url = route('interop.user-group.update', [
            'group_id' => $group->getKey(),
            'playmodes' => ['osu'],
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(422);
    }

    private function createUserWithGroupPlaymodes(string $identifier, array $playmodes, bool $defaultGroup = true): User
    {
        $user = factory(User::class)->create();
        $groupId = $this->getGroupWithPlaymodes($identifier)->getKey();

        $user->userGroups()->create([
            'group_id' => $groupId,
            'playmodes' => $playmodes,
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

    private function getGroupWithPlaymodes(string $identifier): Group
    {
        $group = app('groups')->byIdentifier($identifier);

        $group->update(['has_playmodes' => true]);
        app('groups')->resetCache();

        return $group;
    }

    private function getUserGroupPlaymodes(User $user, Group $group): ?array
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
