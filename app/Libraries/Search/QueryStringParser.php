<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class QueryStringParser
{
    const EXCLUDE_QUOTED_REGEX = '/-(")(?<value>(\\\"|.)*?)"/';
    const EXCLUDE_REGEX = '/-(?<value>\S+)/';
    const QUOTED_REGEX = '/(")(?<value>(\\\"|.)*?)"/';

    public array $excludes = [];
    public array $includes = [];

    public function __construct(public string $queryString)
    {
        $remainder = preg_replace_callback_array([
            static::EXCLUDE_QUOTED_REGEX => function ($m) {
                $this->excludes[] = $m['value'];
                return '';
            },
            static::QUOTED_REGEX => function ($m) {
                $this->includes[] = $m['value'];
                return '';
            },
            static::EXCLUDE_REGEX => function ($m) {
                $this->excludes[] = $m['value'];
                return '';
            },

        ], $queryString);

        \Log::debug($this->includes);

        $tok = strtok($remainder, ' ');

        while ($tok !== false) {
            $this->includes[] = $tok;
            $tok = strtok(' ');
        }
    }

    public function includesForQueryString()
    {

        return implode(' ', $this->includes);
    }

    public function excludesForQueryString()
    {
        return implode(' ', $this->excludes);
    }
}
