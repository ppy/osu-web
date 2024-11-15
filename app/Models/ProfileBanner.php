<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $banner_id
 * @property Country $country
 * @property string $country_acronym
 * @property Tournament $tournament
 * @property int $tournament_id
 * @property User $user
 * @property int $user_id
 */
class ProfileBanner extends Model
{
    protected $table = 'osu_profile_banners';
    protected $primaryKey = 'banner_id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function tournamentBanner(): BelongsTo
    {
        return $this->belongsTo(TournamentBanner::class, 'tournament_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_acronym');
    }

    public function scopeActive(Builder $query): void
    {
        $query->whereHas('tournamentBanner', fn ($q) => $q
            ->where('is_active', true)
            ->where(fn ($countryQuery) => $countryQuery
                ->whereNull('winner_country_acronym')
                ->orWhereColumn(
                    $countryQuery->qualifyColumn('winner_country_acronym'),
                    $query->qualifyColumn('country_acronym'),
                )));
    }

    public function image(): string
    {
        return "{$this->tournamentBanner->banner_url_prefix}{$this->country_acronym}.jpg";
    }
}
