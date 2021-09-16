<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Hashing;

use Illuminate\Hashing\HashManager;

class OsuHashManager extends HashManager
{
    public function createBcryptDriver()
    {
        return new OsuHasher();
    }
}
