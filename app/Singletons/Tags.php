<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Tag;
use App\Traits\Memoizes;
use App\Transformers\TagTransformer;

class Tags
{
    use Memoizes;

    public function get(int $id): ?Tag
    {
        $allById = $this->memoize(
            'allById',
            fn () => Tag::all()->keyBy('id'),
        );

        return $allById[$id] ?? null;
    }

    public function json(): array
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => json_collection(Tag::all(), new TagTransformer()),
        );
    }
}
