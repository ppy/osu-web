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

    private static function cursorSortExecOrder($query, array $sort)
    {
        foreach ($sort as $sortItem) {
            $query->orderBy($sortItem['column'], $sortItem['order']);
        }

        return $query;
    }

    private static function cursorSortExecWhere($query, ?array $preparedCursor)
    {
        if (empty($preparedCursor)) {
            return;
        }

        $current = array_shift($preparedCursor);

        $dir = strtoupper($current['order']) === 'DESC' ? '<' : '>';

        if (count($preparedCursor) === 0) {
            $query->where($current['column'], $dir, $current['value']);
        } else {
            $query->where($current['column'], "{$dir}=", $current['value'])
                ->where(function ($q) use ($current, $dir, $preparedCursor) {
                    return $q->where($current['column'], $dir, $current['value'])
                        ->orWhere(function ($qq) use ($preparedCursor) {
                            static::cursorSortExecWhere($qq, $preparedCursor);
                        });
                });
        }

        return $query;
    }

    public function scopeCursorSort($query, $sortOrCursorHelper, $cursorArrayOrStatic)
    {
        $cursorHelper = $sortOrCursorHelper instanceof DbCursorHelper
            ? $sortOrCursorHelper
            : static::makeDbCursorHelper(get_string($sortOrCursorHelper));

        static::cursorSortExecOrder($query, $cursorHelper->getSort());

        $cursor = $cursorArrayOrStatic instanceof static
            ? $cursorHelper->itemToCursor($cursorArrayOrStatic)
            : $cursorArrayOrStatic;

        static::cursorSortExecWhere($query, $cursorHelper->prepare($cursor));

        return $query;
    }
}
