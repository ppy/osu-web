<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\LegacyBeatmapLeader;

use App\Models\Model as BaseModel;

/**
 * @property int $beatmap_id
 * @property int $user_id
 * @property int $score_id
 */
abstract class Model extends BaseModel
{
    public static function getClassByRuleset(string $ruleset): string
    {
        return 'App\Models\LegacyBeatmapLeader'.'\\'.studly_case($ruleset);
    }

    public $timestamps = null;

    protected $primaryKey = 'beatmap_id';
}
