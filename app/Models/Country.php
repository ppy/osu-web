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
 * @property string $acronym
 * @property int $display
 * @property string $name
 * @property int $playcount
 * @property int $pp
 * @property \Illuminate\Database\Eloquent\Collection $profileBanners ProfileBanner
 * @property int $rankedscore
 * @property float $shipping_rate
 * @property int $usercount
 */
class Country extends Model
{
    protected $table = 'osu_countries';
    protected $primaryKey = 'acronym';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    public function profileBanners()
    {
        return $this->hasMany(ProfileBanner::class, 'country_acronym');
    }

    public function scopeForStore($query)
    {
        return $query->select('acronym', 'name', 'display')
            ->where('display', '>', 0)
            ->orderBy('display', 'desc')
            ->orderBy('name');
    }
}
