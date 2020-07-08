<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class DbCursorHelper
{
    private $sort;
    private $sortName;

    public function __construct($sorts, $defaultSort, $requestedSort = null)
    {
        $this->sortName = $requestedSort;
        $this->sort = $sorts[$requestedSort] ?? null;

        if ($this->sort === null) {
            $this->sort = $sorts[$defaultSort];
            $this->sortName = $defaultSort;
        }
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function getSortName()
    {
        return $this->sortName;
    }

    public function prepare($cursor)
    {
        if (!is_array($cursor)) {
            return;
        }

        $ret = [];

        foreach ($this->sort as $sortItem) {
            $columnInput = $sortItem['columnInput'] ?? $sortItem['column'];
            $column = $sortItem['column'];
            $order = $sortItem['order'];
            $value = get_param_value($cursor[$columnInput] ?? null, $sortItem['type'] ?? null);

            if ($value === null) {
                return;
            }

            $ret[] = compact('column', 'order', 'value');
        }

        return $ret;
    }

    public function prepareNext($items)
    {
        return $this->prepare($this->next($items));
    }

    public function next($items)
    {
        if (count($items) === 0) {
            return;
        }

        $lastItem = $items[count($items) - 1];

        if ($lastItem === null) {
            return;
        }

        $ret = [];

        foreach ($this->sort as $sort) {
            $column = $sort['column'];
            $columnInput = $sort['columnInput'] ?? $sort['column'];
            $ret[$columnInput] = $lastItem->$column;
        }

        return $ret;
    }
}
