<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Group;
use App\Models\UserGroupEvent;
use Tests\TestCase;

class GroupTest extends TestCase
{
    public function testRename()
    {
        $newName = 'new name';
        $group = factory(Group::class)->create(['group_name' => 'name']);
        $groupRenameEventCount = $this->getGroupRenameEventCount($group);

        $group->rename($newName);

        $this->assertSame($group->group_name, $newName);
        $this->assertSame($this->getGroupRenameEventCount($group), $groupRenameEventCount + 1);
    }

    public function testRenameUnchanged()
    {
        $name = 'name';
        $group = factory(Group::class)->create(['group_name' => $name]);
        $groupRenameEventCount = $this->getGroupRenameEventCount($group);

        $group->rename($name);

        $this->assertSame($this->getGroupRenameEventCount($group), $groupRenameEventCount);
    }

    /*
    TODO: This test always fails because it depends on `Group::afterCommit`
    being called right after `create`, but the whole test is wrapped in a
    transaction.

    public function testResetCacheOnSave()
    {
        $previousCacheVersion = cache()->get('groups_local_cache_version');

        Group::create(['group_desc' => '']);

        $this->assertNotSame($previousCacheVersion, cache()->get('groups_local_cache_version'));
    }
    */

    private function getGroupRenameEventCount(Group $group): int
    {
        return UserGroupEvent::where([
            'group_id' => $group->getKey(),
            'type' => UserGroupEvent::GROUP_RENAME,
        ])->count();
    }
}
