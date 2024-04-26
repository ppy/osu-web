<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Singletons;

use App\Exceptions\ContentModerationException;
use App\Models\ChatFilter;
use App\Traits\Memoizes;

class ChatFilters
{
    use Memoizes;

    /**
     * Applies all active chat filters to the provided text.
     * @param string $text The text to filter.
     * @return string The text after filtering.
     * @throws ContentModerationException If the text matches one of the filters which indicate that the input
     * should be discarded entirely.
     */
    public function filter(string $text): string
    {
        $filters = $this->memoize(__FUNCTION__, function () {
            $ret = [];

            $allFilters = ChatFilter::all();

            // blocking filters (finding any of these phrases throws moderation exceptions)
            $blockingFilters = $allFilters->where('block', true);
            if (!$blockingFilters->isEmpty()) {
                $ret['block_regex'] = self::combinedFilterRegex($blockingFilters);
            }

            // non-blocking filters (phrases are allowed to be replaced)
            $replaceFilters = $allFilters->where('block', false);

            $ret['whitespace_delimited_replaces'] = $replaceFilters->where('whitespace_delimited', true)->collect();
            $ret['non_whitespace_delimited_replaces'] = $replaceFilters->where('whitespace_delimited', false)->collect();

            return $ret;
        });

        if (isset($filters['block_regex']) && preg_match($filters['block_regex'], $text)) {
            throw new ContentModerationException();
        }

        $text = strtr(
            $text,
            $filters['non_whitespace_delimited_replaces']->mapWithKeys(fn ($filter) => [$filter->match => $filter->replacement])->all()
        );
        return preg_replace(
            $filters['whitespace_delimited_replaces']->map(fn ($filter) => self::singleFilterRegex($filter))->toArray(),
            $filters['whitespace_delimited_replaces']->map(fn ($filter) => $filter->replacement)->toArray(),
            $text
        );
    }

    private static function singleFilterRegex(ChatFilter $filter): string
    {
        $term = preg_quote($filter->match);
        if ($filter->whitespace_delimited) {
            $term = '\b'.$term.'\b';
        }
        return '('.$term.')';
    }

    private static function combinedFilterRegex($filters): string
    {
        $regex = implode('|', $filters->map(fn ($filter) => '('.self::singleFilterRegex($filter).')')->toArray());
        return '/'.$regex.'/';
    }
}
