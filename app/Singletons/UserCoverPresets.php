<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\User;
use App\Models\UserCoverPreset;
use App\Traits\Memoizes;
use App\Transformers\UserCoverPresetTransformer;
use Illuminate\Support\Collection;

class UserCoverPresets
{
    use Memoizes;

    public function defaultForUser(User $user): UserCoverPreset
    {
        $userId = max(0, $user->getKey() ?? 0);

        $active = $this->allActive();
        $count = $active->count();

        return $count === 0
            ? new UserCoverPreset()
            : $active[$userId % $count];
    }

    public function find(int $id): ?UserCoverPreset
    {
        $allById = $this->memoize(
            __FUNCTION__,
            fn () => UserCoverPreset::all()->keyBy('id'),
        );

        // use key check as it may be null
        if (!$allById->has($id)) {
            $allById[$id] = UserCoverPreset::find($id);
        }

        return $allById[$id];
    }

    public function json(): array
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => json_collection($this->allActive(), new UserCoverPresetTransformer()),
        );
    }

    private function allActive(): Collection
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => UserCoverPreset::active()->orderBy('id')->get(),
        );
    }
}
