<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

interface Queryable
{
    /**
     * Returns the built query as an associative array.
     *
     * @return array
     */
    public function toArray(): array;
}
