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

    public function scopeCursorSort($query, $sortOrCursorHelper, $cursorArrayOrStatic)
    {
        $cursorHelper = $sortOrCursorHelper instanceof DbCursorHelper
            ? $sortOrCursorHelper
            : static::makeDbCursorHelper(get_string($sortOrCursorHelper));

        $cursor = $cursorArrayOrStatic instanceof static
            ? $cursorHelper->next($cursorArrayOrStatic)
            : $cursorArrayOrStatic;

        $preparedCursor = $cursorHelper->prepare($cursor);

        foreach ($cursorHelper->getSort() as $sortItem) {
            $query->orderBy($sortItem['column'], $sortItem['order']);
        }

        if (is_array($preparedCursor)) {
            $query->cursorSortExec($preparedCursor);
        }
    }

    public function scopeCursorSortExec($query, array $cursors)
    {
        if (empty($cursors)) {
            return;
        }

        $cursor = array_shift($cursors);

        $dir = strtoupper($cursor['order']) === 'DESC' ? '<' : '>';

        if (count($cursors) === 0) {
            $query->where($cursor['column'], $dir, $cursor['value']);
        } else {
            $query->where($cursor['column'], "{$dir}=", $cursor['value'])
                ->where(function ($q) use ($cursor, $dir, $cursors) {
                    $q->where($cursor['column'], $dir, $cursor['value'])
                        ->orWhere(function ($qq) use ($cursors) {
                            $qq->cursorSortExec($cursors);
                        });
                });
        }
    }
}
