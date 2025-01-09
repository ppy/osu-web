<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Tag;
use App\Traits\Memoizes;
use App\Transformers\TagTransformer;
use Illuminate\Support\Collection;

class Tags
{
    use Memoizes;

    /**
     * @return Collection<Tag>
     */
    public function all(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => Tag::all());
    }

    public function get(int $id): ?Tag
    {
        $allById = $this->memoize(
            'allById',
            fn () => $this->all()->keyBy('id'),
        );

        return $allById[$id] ?? null;
    }

    public function json(): array
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => json_collection($this->all(), new TagTransformer()),
        );
    }
}
