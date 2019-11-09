<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
