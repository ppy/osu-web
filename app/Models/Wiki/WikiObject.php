<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Wiki;

interface WikiObject
{
    /**
     * Fetches the representation of the object, renders it, and stores it in the cache.
     */
    public function sync($force = false);
}
