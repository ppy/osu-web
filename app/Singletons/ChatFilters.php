<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Singletons;

use App\Models\ChatFilter;
use App\Traits\Memoizes;

class ChatFilters
{
    use Memoizes;

    public function filter(string $text): string
    {
        $replacements = $this->memoize(__FUNCTION__, function () {
            $ret = [];
            foreach (ChatFilter::all() as $entry) {
                $ret[$entry->match] = $entry->replacement;
            }

            return $ret;
        });

        return strtr($text, $replacements);
    }
}
