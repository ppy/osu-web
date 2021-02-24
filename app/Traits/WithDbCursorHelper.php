<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Traits;

use App\Libraries\DbCursorHelper;

trait WithDbCursorHelper
{
    public static function makeDbCursorHelper(?string $sort = null)
    {
        return new DbCursorHelper(static::SORTS, static::DEFAULT_SORT, $sort);
    }

    public function scopeCursorSort($query, $sortOrCursorHelper, ?array $cursor)
    {
        $cursorHelper = $sortOrCursorHelper instanceof DbCursorHelper
            ? $sortOrCursorHelper
            : static::makeDbCursorHelper(get_string($sortOrCursorHelper));

        $preparedCursor = $cursorHelper->prepare($cursor);

        foreach ($cursorHelper->getSort() as $sortItem) {
            $query->orderBy($sortItem['column'], $sortItem['order']);
        }

        if (is_array($preparedCursor)) {
            $query->cursorWhere($preparedCursor, false);
        }
    }
}
