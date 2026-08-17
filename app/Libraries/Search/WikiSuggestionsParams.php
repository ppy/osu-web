<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class WikiSuggestionsParams extends WikiSearchParams
{
    public $size = 10;

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldReturnEmptyResponse(): bool
    {
        return $this->isQueryStringTooShort();
    }
}
