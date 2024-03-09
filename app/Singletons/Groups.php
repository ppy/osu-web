<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Singletons;

use App\Models\Group;
use App\Traits\Memoizes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Groups
{
    use Memoizes;

    /**
     * Get all groups.
     */
    public function all(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => $this->fetch());
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
    public function byId(int|string|null $id): ?Group
    {
        return $this->allById()->get($id);
    }

    /**
     * Get a group by its ID or throw an exception.
     *
     * @throws ModelNotFoundException
     */
    public function byIdOrFail(int|string|null $id): Group
    {
        return $this->byId($id)
            ?? throw (new ModelNotFoundException())->setModel(Group::class, (int) $id);
    }

    /**
     * Get a group by its identifier (e.g. "admin").
     */
    public function byIdentifier(string $id): ?Group
    {
        return $this->allByIdentifier()->get($id);
    }

    protected function fetch(): Collection
    {
        return Group::orderBy('display_order')->get();
    }
}
