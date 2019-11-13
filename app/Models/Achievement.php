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

namespace App\Models;

/**
 * @property int $achievement_id
 * @property string|null $description
 * @property bool $enabled
 * @property string $grouping
 * @property string|null $image
 * @property int|null $mode
 * @property string $name
 * @property int $ordering
 * @property int $progression
 * @property string|null $quest_instructions
 * @property int|null $quest_ordering
 * @property string $slug
 */
class Achievement extends Model
{
    protected $table = 'osu_achievements';
    protected $primaryKey = 'achievement_id';

    protected $casts = [
        'enabled' => 'boolean',
    ];
    public $timestamps = false;
    public $incrementing = false;

    public function getModeAttribute($value)
    {
        if (!present($value)) {
            return;
        }

        return Beatmap::modeStr((int) $value);
    }

    public function scopeAchievable($query)
    {
        return $query
            ->where('enabled', true)
            ->where('slug', '<>', '');
    }

    public function iconUrl()
    {
        return config('osu.achievement.icon_prefix').e($this->slug).'.png';
    }
}
