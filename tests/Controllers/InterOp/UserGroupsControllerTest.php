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
        $userAddEventCount = $this->getUserAddEventCount($user, $group);
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
        $this->assertSame($this->getUserAddEventCount($user, $group), $userAddEventCount + 1);
    }

    public function testUserGroupAddWhenAlreadyMember()
    {
        $user = $this->createUserWithGroup('gmt');
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->getUserAddEventCount($user, $group);
        $url = route('interop.user-groups.store', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $this->assertSame($this->getUserAddEventCount($user, $group), $userAddEventCount);
    }

    public function testUserGroupRemove()
    {
        $user = $this->createUserWithGroup('gmt');
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->getUserRemoveEventCount($user, $group);
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
        $this->assertSame($this->getUserRemoveEventCount($user, $group), $userRemoveEventCount + 1);
    }

    public function testUserGroupRemoveWhenNotMember()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->getUserRemoveEventCount($user, $group);
        $url = route('interop.user-groups.destroy', [
            'group_id' => $group->getKey(),
            'timestamp' => time(),
            'user_id' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->delete($url)
            ->assertStatus(204);

        $this->assertSame($this->getUserRemoveEventCount($user, $group), $userRemoveEventCount);
    }

    public function testUserGroupSetDefault()
    {
        $user = $this->createUserWithGroup('gmt', ['group_id' => app('groups')->byIdentifier('default')->getKey()]);
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->getUserAddEventCount($user, $group);
        $userSetDefaultEventCount = $this->getUserSetDefaultEventCount($user, $group);
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
        $this->assertSame($this->getUserAddEventCount($user, $group), $userAddEventCount);
        $this->assertSame($this->getUserSetDefaultEventCount($user, $group), $userSetDefaultEventCount + 1);
    }

    public function testUserGroupSetDefaultWhenNotMember()
    {
        $user = factory(User::class)->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->getUserAddEventCount($user, $group);
        $userSetDefaultEventCount = $this->getUserSetDefaultEventCount($user, $group);
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
        $this->assertSame($this->getUserAddEventCount($user, $group), $userAddEventCount + 1);
        $this->assertSame($this->getUserSetDefaultEventCount($user, $group), $userSetDefaultEventCount + 1);
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

    private function getUserAddEventCount(User $user, Group $group): int
    {
        return UserGroupEvent::where([
            'group_id' => $group->getKey(),
            'type' => UserGroupEvent::USER_ADD,
            'user_id' => $user->getKey(),
        ])->count();
    }

    private function getUserRemoveEventCount(User $user, Group $group): int
    {
        return UserGroupEvent::where([
            'group_id' => $group->getKey(),
            'type' => UserGroupEvent::USER_REMOVE,
            'user_id' => $user->getKey(),
        ])->count();
    }

    private function getUserSetDefaultEventCount(User $user, Group $group): int
    {
        return UserGroupEvent::where([
            'group_id' => $group->getKey(),
            'type' => UserGroupEvent::USER_SET_DEFAULT,
            'user_id' => $user->getKey(),
        ])->count();
    }
}
