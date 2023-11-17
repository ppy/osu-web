<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    const UNKNOWN = 'XX';

    protected $table = 'osu_countries';
    protected $primaryKey = 'acronym';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    public function scopeForStore($query)
    {
        return $query->select('acronym', 'name', 'display')
            ->where('display', '>', 0)
            ->orderBy('display', 'desc')
            ->orderBy('name');
    }

    public function scopeWhereHasRuleset(Builder $query, string $ruleset): Builder
    {
        return $query->whereHas(
            'statistics',
            fn ($q) => $q
                ->where('display', true)
                ->where('mode', Beatmap::MODES[$ruleset]),
        );
    }

    public function profileBanners()
    {
        return $this->hasMany(ProfileBanner::class, 'country_acronym');
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(CountryStatistics::class, 'country_code');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'acronym',
            'display',
            'name',
            'playcount',
            'pp',
            'rankedscore',
            'shipping_rate',
            'usercount' => $this->getRawAttribute($key),

            'profileBanners',
            'statistics' => $this->getRelationValue($key),
        };
    }
}
