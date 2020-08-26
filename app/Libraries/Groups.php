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
            $this->fetch();
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

    public function fetch()
    {
        $localCacheVersion = cache()->get('groups_local_cache_version');
        $localStorage = config('cache.local');

        if ($localCacheVersion === null) {
            $localCacheVersion = hrtime(true);
            cache()->forever('groups_local_cache_version', $localCacheVersion);
        }

        $localCacheKey = "groups:v{$localCacheVersion}";
        $this->groups = cache()->store($localStorage)->get($localCacheKey);

        if ($this->groups === null) {
            $this->groups = Group::orderBy('display_order')->get();
            cache()->store($localStorage)->forever($localCacheKey, $this->groups);
        }
    }

    public function resetCache()
    {
        cache()->forget('groups_local_cache_version');
    }

    private function reset()
    {
        $this->resetCache();
        $this->groups = null;
        $this->groupsById = null;
        $this->groupsByIdentifier = null;
    }
}
