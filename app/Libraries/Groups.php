<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Group;

class Groups
{
    private $groups;
    private $groupsById;
    private $groupsByIdentifier;

    public function all()
    {
        if (!isset($this->groups)) {
            $this->groups = Group::orderBy('display_order')->get();
        }

        return $this->groups;
    }

    public function byId($id)
    {
        if (!isset($this->groupsById)) {
            $this->groupsById = $this->all()->keyBy('group_id');
        }

        return $this->groupsById[$id] ?? null;
    }

    public function byIdentifier($id)
    {
        if (!isset($this->groupsByIdentifier)) {
            $this->groupsByIdentifier = $this->all()->keyBy('identifier');
        }

        $group = $this->groupsByIdentifier[$id] ?? null;

        if ($group === null) {
            Group::create([
                'identifier' => $id,
                'group_name' => $id,
                'group_desc' => $id,
                'short_name' => $id,
            ]);

            $this->reset();

            return $this->byIdentifier($id);
        }

        return $group;
    }

    private function reset()
    {
        $this->groups = null;
        $this->groupsById = null;
        $this->groupsByIdentifier = null;
    }
}
