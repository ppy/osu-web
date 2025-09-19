<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\LegacyScoreFirst;

use App\Models\Beatmap;

class Fruits extends Model
{
    protected static int $rulesetId = Beatmap::MODES['fruits'];

    protected $table = 'osu_leaders_fruits';
}
