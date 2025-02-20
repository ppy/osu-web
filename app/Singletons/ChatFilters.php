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

    private static function singleFilterRegex(ChatFilter $filter, string $delimiter): string
    {
        $term = preg_quote($filter->match, $delimiter);
        if ($filter->whitespace_delimited) {
            $term = '\b'.$term.'\b';
        }
        return $term;
    }

    private static function combinedFilterRegex($filters): string
    {
        $regex = $filters->map(fn ($filter) => self::singleFilterRegex($filter, '/'))->join('|');

        return "/{$regex}/iu";
    }

    public function isClean(string $text): bool
    {
        $filters = $this->filterRegexps();

        foreach ($filters['non_whitespace_delimited_replaces'] as $search => $_replacement) {
            if (stripos($text, $search) !== false) {
                return false;
            }
        }

        $patterns = [
            $filters['block_regex'] ?? null,
            ...array_keys($filters['whitespace_delimited_replaces']),
        ];

        foreach ($patterns as $pattern) {
            if ($pattern !== null && preg_match($pattern, $text)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Applies all active chat filters to the provided text.
     * @param string $text The text to filter.
     * @return string The text after filtering.
     * @throws ContentModerationException If the text matches one of the filters which indicate that the input
     * should be discarded entirely.
     */
    public function filter(string $text): string
    {
        $filters = $this->filterRegexps();

        if (isset($filters['block_regex']) && preg_match($filters['block_regex'], $text)) {
            throw new ContentModerationException();
        }

        $text = str_ireplace(
            array_keys($filters['non_whitespace_delimited_replaces']),
            array_values($filters['non_whitespace_delimited_replaces']),
            $text
        );
        return preg_replace(
            array_keys($filters['whitespace_delimited_replaces']),
            array_values($filters['whitespace_delimited_replaces']),
            $text
        );
    }

    private function filterRegexps(): array
    {
        return $this->memoize(__FUNCTION__, function () {
            $ret = [];

            $allFilters = ChatFilter::all();

            // blocking filters (finding any of these phrases throws moderation exceptions)
            $blockingFilters = $allFilters->where('block', true);
            if (!$blockingFilters->isEmpty()) {
                $ret['block_regex'] = self::combinedFilterRegex($blockingFilters);
            }

            // non-blocking filters (phrases are allowed to be replaced)
            $replaceFilters = $allFilters->where('block', false);

            $ret['whitespace_delimited_replaces'] = $replaceFilters
                ->where('whitespace_delimited', true)
                ->mapWithKeys(fn ($filter) => ['/'.self::singleFilterRegex($filter, '/').'/iu' => $filter->replacement])
                ->all();
            $ret['non_whitespace_delimited_replaces'] = $replaceFilters
                ->where('whitespace_delimited', false)
                ->mapWithKeys(fn ($filter) => [$filter->match => $filter->replacement])
                ->all();

            return $ret;
        });
    }
}
