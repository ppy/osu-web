<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Models\Smiley;
use App\Traits\Memoizes;

class Smilies
{
    use Memoizes;

    public function all(): array
    {
        return $this->memoize(__FUNCTION__, fn () => $this->fetch());
    }

    protected function fetch(): array
    {
        return Smiley::orderBy(\DB::raw('LENGTH(code)'), 'desc')->get()->toArray();
    }
}
