<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Group;
use App\Traits\Memoizes;
use Illuminate\Database\Eloquent\Collection;

class Groups
{
    use Memoizes;

    /**
     * Get all groups.
     */
    public function all(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->fetch();
        });
    }

    /**
     * Get all groups keyed by ID.
     */
    public function allById(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->all()->keyBy('group_id');
        });
    }

    /**
     * Get all groups keyed by identifier (e.g. "admin").
     */
    public function allByIdentifier(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->all()->keyBy('identifier');
        });
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
        return $this->allByIdentifier()->get($id) ??
            Group::create([
                'identifier' => $id,
                'group_name' => $id,
                'group_desc' => $id,
                'short_name' => $id,
            ]);
    }

    /**
     * Reset groups cache.
     */
    public function resetCache(): void
    {
        cache()->put('groups_local_cache_version', hrtime(true));

        $this->resetMemoized();
    }

    /**
     * Fetch groups data.
     *
     * This data is being used on every request so fetching them directly
     * from external database will cause unnecessary load on network.
     *
     * Store the data locally on each servers and use normal shared cache
     * to indicate the servers whether or not to reset the local cache.
     *
     * Expiration doesn't really exist on file storage cache so in some rare
     * cases (like testing) using file storage for local cache will generate
     * lots of files. Array storage should be used in those cases.
     * In normal use where groups don't change there shouldn't be too many
     * files generated.
     */
    private function fetch(): Collection
    {
        $localCacheVersion = cache()->get('groups_local_cache_version');
        $localStorage = config('cache.local');

        if ($localCacheVersion === null) {
            $localCacheVersion = hrtime(true);
            cache()->forever('groups_local_cache_version', $localCacheVersion);
        }

        $localCacheKey = "groups:v{$localCacheVersion}";
        $groups = cache()->store($localStorage)->get($localCacheKey);

        if ($groups === null) {
            $groups = Group::orderBy('display_order')->get();
            cache()->store($localStorage)->forever($localCacheKey, $groups);
        }

        return $groups;
    }
}
