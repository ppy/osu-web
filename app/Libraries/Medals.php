<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Models\Achievement;
use App\Traits\Memoizes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Medals
{
    use Memoizes;

    /**
     * Get all enabled medals.
     */
    public function all(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this
                ->allIncludeDisabled()
                // From `Achievement::scopeAchievable()`
                ->where('enabled', true)
                ->where('slug', '<>', '');
        });
    }

    /**
     * Get all enabled medals keyed by ID.
     */
    public function allById(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => $this->all()->keyBy('achievement_id'));
    }

    /**
     * Get all enabled medals keyed by slug.
     */
    public function allBySlug(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => $this->all()->keyBy('slug'));
    }

    /**
     * Get an enabled medal by its ID.
     */
    public function byId(int|string|null $id): ?Achievement
    {
        return $this->allById()->get($id);
    }

    /**
     * Get an enabled medal by its ID or throw an exception.
     *
     * @throws ModelNotFoundException
     */
    public function byIdOrFail(int|string|null $id): Achievement
    {
        return $this->byId($id)
            ?? throw (new ModelNotFoundException())->setModel(Achievement::class, (int) $id);
    }

    /**
     * Get a medal by its name.
     */
    public function byNameIncludeDisabled(string $name): ?Achievement
    {
        return $this->allByNameIncludeDisabled()->get($name);
    }

    /**
     * Get an enabled medal by its slug.
     */
    public function bySlug(string $slug): ?Achievement
    {
        return $this->allBySlug()->get($slug);
    }

    private function allByNameIncludeDisabled(): Collection
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => $this->allIncludeDisabled()->keyBy('name'),
        );
    }

    private function allIncludeDisabled(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            return Achievement
                ::orderBy('grouping')
                ->orderBy('ordering')
                ->orderBy('progression')
                ->get();
        });
    }
}
