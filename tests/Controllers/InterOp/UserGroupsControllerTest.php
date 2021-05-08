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
}
