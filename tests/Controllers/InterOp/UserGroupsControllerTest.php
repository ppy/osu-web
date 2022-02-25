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
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $url = route('interop.user-group.update', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
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
        $user = User::factory()->withGroup('gmt')->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $url = route('interop.user-group.update', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(204);

        $user->refresh();

        $this->assertTrue($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_ADD, $user, $group),
            $userAddEventCount,
        );
    }

    public function testUserGroupAddWhenHasSamePlaymodes()
    {
        $playmodes = ['osu'];
        $user = User::factory()->withGroup('nat', $playmodes)->create();
        $group = app('groups')->byIdentifier('nat');
        $userAddPlaymodesEventCount = $this->eventCount(UserGroupEvent::USER_ADD_PLAYMODES, $user, $group);
        $url = route('interop.user-group.update', [
            'group' => $group->getKey(),
            'playmodes' => $playmodes,
            'timestamp' => time(),
            'user' => $user->getKey(),
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
        $user = User::factory()->withGroup('nat', ['osu', 'taiko'])->create();
        $group = app('groups')->byIdentifier('nat');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userAddPlaymodesEventCount = $this->eventCount(UserGroupEvent::USER_ADD_PLAYMODES, $user, $group);
        $userRemovePlaymodesEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE_PLAYMODES, $user, $group);
        $url = route('interop.user-group.update', [
            'group' => $group->getKey(),
            'playmodes' => $playmodes,
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(204);

        $user->refresh();

        $actualPlaymodes = $user->findUserGroup($group, true)->playmodes;

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
        $user = User::factory()->withGroup('gmt')->create();
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group);
        $url = route('interop.user-group.destroy', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
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
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('gmt');
        $userRemoveEventCount = $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group);
        $url = route('interop.user-group.destroy', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->delete($url)
            ->assertStatus(204);

        $user->refresh();

        $this->assertFalse($user->isGroup($group));
        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_REMOVE, $user, $group),
            $userRemoveEventCount,
        );
    }

    public function testUserGroupSetDefault()
    {
        $user = User::factory()->withGroup('gmt')->create(['group_id' => app('groups')->byIdentifier('default')]);
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userSetDefaultEventCount = $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group);
        $url = route('interop.user-group.set-default', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
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

    public function testUserGroupSetDefaultLeavesPlaymodesUnchanged()
    {
        $playmodes = ['osu'];
        $user = User::factory()->withGroup('nat', $playmodes)->create(['group_id' => app('groups')->byIdentifier('default')->getKey()]);
        $group = app('groups')->byIdentifier('nat');
        $url = route('interop.user-group.set-default', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $user->refresh();

        $actualPlaymodes = $user->findUserGroup($group, true)->playmodes;

        $this->assertCount(count($playmodes), $actualPlaymodes);
        $this->assertArraySubset($playmodes, $actualPlaymodes);
    }

    public function testUserGroupSetDefaultWhenAlreadyDefault()
    {
        $user = User::factory()->withGroup('gmt')->create();
        $group = app('groups')->byIdentifier('gmt');
        $userSetDefaultEventCount = $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group);
        $url = route('interop.user-group.set-default', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertStatus(204);

        $this->assertSame(
            $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group),
            $userSetDefaultEventCount,
        );
    }

    public function testUserGroupSetDefaultWhenNotMember()
    {
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('gmt');
        $userAddEventCount = $this->eventCount(UserGroupEvent::USER_ADD, $user, $group);
        $userSetDefaultEventCount = $this->eventCount(UserGroupEvent::USER_SET_DEFAULT, $user, $group);
        $url = route('interop.user-group.set-default', [
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
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

    public function testInvalidPlaymodes()
    {
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('nat');
        $group->update(['has_playmodes' => true]);
        $url = route('interop.user-group.update', [
            'group' => $group->getKey(),
            'playmodes' => ['osu', 'invalid_playmode'],
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(422);
    }

    public function testPlaymodesWithoutGroupPlaymodesSet()
    {
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('gmt');
        $url = route('interop.user-group.update', [
            'group' => $group->getKey(),
            'playmodes' => ['osu'],
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->put($url)
            ->assertStatus(422);
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
