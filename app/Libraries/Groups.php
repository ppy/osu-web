<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Group;
use App\Traits\LocallyCached;
use Illuminate\Database\Eloquent\Collection;

class Groups
{
    use LocallyCached;

    /**
     * Get all groups.
     */
    public function all(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => $this->cachedFetch());
    }

    /**
     * Get all groups keyed by ID.
     */
    public function allById(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => $this->all()->keyBy('group_id'));
    }

    /**
     * Get all groups keyed by identifier (e.g. "admin").
     */
    public function allByIdentifier(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => $this->all()->keyBy('identifier'));
    }

    /**
     * Get a group by its ID.
     */
    public function byId(?int $id): ?Group
    {
        return $this->allById()->get($id);
    }

    /**
     * Get a group by its identifier (e.g. "admin").
     *
     * If the requested group doesn't exist, a new one is created.
     */
    public function byIdentifier(string $id): Group
    {
        $group = $this->allByIdentifier()->get($id);

        if ($group === null) {
            $group = Group::create([
                'identifier' => $id,
                'group_name' => $id,
                'group_desc' => $id,
                'short_name' => $id,
            ])->fresh();

            // TODO: This shouldn't have to be called here, since it's already
            // called by `Group::afterCommit`, but `Group::afterCommit` isn't
            // running in tests when creating/saving `Group`s.
            $this->resetCache();
        }

        return $group;
    }

    protected function fetch(): Collection
    {
        return Group::orderBy('display_order')->get();
    }
}
