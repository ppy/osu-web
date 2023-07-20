<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $count
 * @property Country $country
 * @property string $country_acronym
 * @property User $user
 * @property int $user_id
 * @property \Carbon\Carbon $last_updated
 * @property string $year_month
 */
class UserCountryHistory extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = ['last_updated' => 'datetime'];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'year_month', 'country_acronym'];
    protected $table = 'user_country_history';

    public static function formatDate(\DateTimeInterface $date): string
    {
        return $date->format('ym');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_acronym');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setYearMonthAttribute(\DateTimeInterface|string $value): void
    {
        $this->attributes['year_month'] = $value instanceof \DateTimeInterface
            ? static::formatDate($value)
            : $value;
    }
}
