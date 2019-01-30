<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
