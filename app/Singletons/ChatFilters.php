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
            foreach (ChatFilter::all() as $entry) {
                $ret[$entry->match] = $entry;
            }

            return $ret;
        });


        // blocking filters (finding any of these phrases throws moderation exceptions)
        $blockingFilters = array_where($filters, fn ($filter) => $filter->block);
        if (!empty($blockingFilters) && preg_match(self::combinedFilterRegex($blockingFilters), $text)) {
            throw new ContentModerationException();
        }

        // non-blocking filters (phrases are allowed to be replaced)
        $replaceFilters = array_where($filters, fn ($filter) => !$filter->block);

        $whitespaceFilters = array_where($replaceFilters, fn ($filter) => $filter->whitespace_delimited);
        $nonWhitespaceFilters = array_where($replaceFilters, fn ($filter) => !$filter->whitespace_delimited);

        $text = strtr($text, array_reduce($nonWhitespaceFilters, function ($map, $filter) {
            $map[$filter->match] = $filter->replacement;
            return $map;
        }, []));
        return preg_replace(
            array_map(fn ($filter) => self::singleFilterRegex($filter), $whitespaceFilters),
            array_map(fn ($filter) => $filter->replacement, $whitespaceFilters),
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
        $regex = implode('|', array_map(fn ($filter) => '('.self::singleFilterRegex($filter).')', $filters));
        return '/'.$regex.'/';
    }
}
