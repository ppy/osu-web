<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Libraries\DbCursorHelper;

trait WithDbCursorHelper
{
    public static function makeDbCursorHelper(?string $sort = null)
    {
        return new DbCursorHelper(static::SORTS, static::DEFAULT_SORT, $sort);
    }

    private static function cursorSortExecOrder($query, array $sort)
    {
        foreach ($sort as $i => $sortItem) {
            $orderMethod = $i === 0 ? 'reorderBy' : 'orderBy';
            $query->$orderMethod($sortItem['column'], $sortItem['order']);
        }

        return $query;
    }

    private static function cursorSortExecWhere($query, ?array $preparedCursor)
    {
        if (empty($preparedCursor)) {
            return $query;
        }

        $current = array_shift($preparedCursor);

        $dir = $current['order'] === 'DESC' ? '<' : '>';

        if (count($preparedCursor) === 0) {
            $query->where($current['column'], $dir, $current['value']);
        } else {
            $query->where($current['column'], "{$dir}=", $current['value'])
                ->where(function ($q) use ($current, $dir, $preparedCursor) {
                    return $q->where($current['column'], $dir, $current['value'])
                        ->orWhere(function ($qq) use ($preparedCursor) {
                            return static::cursorSortExecWhere($qq, $preparedCursor);
                        });
                });
        }

        return $query;
    }

    /**
     * Builds a cursor-based sort query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query Input query to be extended.
     * @param string|DbCursorHelper $sortOrCursorHelper Either sort name to create DbCursorHelper or existing DbCursorHelper.
     * @param array|static $cursorOrStatic Either an input cursor array or object instance to generate cursor array from.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCursorSort($query, $sortOrCursorHelper, $cursorOrStatic)
    {
        $cursorHelper = $sortOrCursorHelper instanceof DbCursorHelper
            ? $sortOrCursorHelper
            : static::makeDbCursorHelper(get_string($sortOrCursorHelper));

        $query = static::cursorSortExecOrder($query, $cursorHelper->getSort());

        $cursor = $cursorOrStatic instanceof static
            ? $cursorHelper->itemToCursor($cursorOrStatic)
            : $cursorOrStatic;

        return static::cursorSortExecWhere($query, $cursorHelper->prepare($cursor));
    }
}
