<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Group;
use App\Traits\Memoizes;
use Exception;
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
     *
     * If the requested group doesn't exist, a new one is created.
     */
    public function byIdentifier(string $id): Group
    {
        $group = $this->allByIdentifier()->get($id);

        if ($group === null) {
            try {
                $group = Group::create([
                    'group_desc' => '',
                    'group_name' => $id,
                    'group_type' => 2,
                    'identifier' => $id,
                    'short_name' => $id,
                ])->fresh();
            } catch (Exception $ex) {
                if (!is_sql_unique_exception($ex)) {
                    throw $ex;
                }
                $group = Group::firstWhere(['identifier' => $id]);
            }

            // TODO: This shouldn't have to be called here, since it's already
            // called by `Group::afterCommit`, but `Group::afterCommit` isn't
            // running in tests when creating/saving `Group`s.
            $this->resetMemoized();
        }

        return $group;
    }

    protected function fetch(): Collection
    {
        return Group::orderBy('display_order')->get();
    }
}
