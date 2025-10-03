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

        $actualPlaymodes = $user->findUserGroup($group)->playmodes;

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

        $actualPlaymodes = $user->findUserGroup($group)->playmodes;

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

    /**
     * @dataProvider userGroupRoutesDataProvider
     */
    public function testWithActor(string $type, string $method, string $route): void
    {
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('gmt');
        $actor = User::factory()->create();
        $url = route($route, [
            'actor_id' => $actor->getKey(),
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        if ($type === UserGroupEvent::USER_REMOVE) {
            $user->addToGroup($group);
        }

        $this->expectCountChange(
            fn () => $this->eventCount($type, $user, $group, $actor),
            1,
        );

        $this
            ->withInterOpHeader($url)
            ->$method($url)
            ->assertStatus(204);
    }

    /**
     * @dataProvider userGroupRoutesDataProvider
     */
    public function testWithInvalidActor(string $type, string $method, string $route): void
    {
        $user = User::factory()->create();
        $group = app('groups')->byIdentifier('gmt');
        $url = route($route, [
            'actor_id' => $user->getKey() + 1,
            'group' => $group->getKey(),
            'timestamp' => time(),
            'user' => $user->getKey(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->$method($url)
            ->assertStatus(404);
    }

    public static function userGroupRoutesDataProvider(): array
    {
        return [
            'add' =>
                [UserGroupEvent::USER_ADD, 'put', 'interop.user-group.update'],
            'remove' =>
                [UserGroupEvent::USER_REMOVE, 'delete', 'interop.user-group.destroy'],
            'set default' =>
                [UserGroupEvent::USER_SET_DEFAULT, 'post', 'interop.user-group.set-default'],
        ];
    }

    private function eventCount(string $type, User $user, Group $group, ?User $actor = null): int
    {
        return UserGroupEvent
            ::where([
                'actor_id' => $actor?->getKey(),
                'group_id' => $group->getKey(),
                'type' => $type,
                'user_id' => $user->getKey(),
            ])
            ->count();
    }
}
