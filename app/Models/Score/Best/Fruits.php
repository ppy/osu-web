<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score\Best;

/**
 * @property int $beatmap_id
 * @property int $count100
 * @property int $count300
 * @property int $count50
 * @property int $countgeki
 * @property int $countkatu
 * @property int $countmiss
 * @property string $country_acronym
 * @property \Carbon\Carbon $date
 * @property int $enabled_mods
 * @property int $hidden
 * @property int $maxcombo
 * @property bool $perfect
 * @property float|null $pp
 * @property mixed $rank
 * @property bool $replay
 * @property int $score
 * @property int $score_id
 * @property int $user_id
 */
class Fruits extends Model
{
    protected $table = 'osu_scores_fruits_high';
}
