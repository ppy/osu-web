<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
