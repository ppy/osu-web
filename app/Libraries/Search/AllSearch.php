<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class AllSearch extends MultiSearch
{
    public function showMore()
    {
        return $this->getMode() === 'all';
    }

    public function visibleSearches()
    {
        $visible = [];
        foreach ($this->searches() as $mode => $search) {
            if ($search !== null && ($this->getMode() === $mode || $this->getMode() === 'all')) {
                $visible[$mode] = $search;
            }
        }

        return $visible;
    }
}
