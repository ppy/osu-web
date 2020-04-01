<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score;

/**
 * @property int $beatmap_id
 * @property int $beatmapset_id
 * @property int $count100
 * @property int $count300
 * @property int $count50
 * @property int $countgeki
 * @property int $countkatu
 * @property int $countmiss
 * @property \Carbon\Carbon $date
 * @property int $enabled_mods
 * @property int|null $high_score_id
 * @property int $maxcombo
 * @property int $pass
 * @property bool $perfect
 * @property mixed $rank
 * @property int $score
 * @property int $score_id
 * @property mixed $scorechecksum
 * @property int $user_id
 */
class Mania extends Model
{
    protected $table = 'osu_scores_mania';
}
