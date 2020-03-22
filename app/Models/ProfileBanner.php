<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

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
    protected $macros = ['active'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_acronym');
    }

    public function macroActive()
    {
        return function ($query) {
            $last = $query->orderBy('banner_id', 'DESC')->first();

            if ($last !== null && $last->isActive()) {
                return $last;
            }
        };
    }

    public function image()
    {
        $period = $this->period();

        if ($period !== null) {
            $prefix = config("osu.tournament_banner.{$period}.prefix");

            return "{$prefix}{$this->country_acronym}.jpg";
        }
    }

    public function isActive()
    {
        $period = $this->period();

        return $period === 'current' ||
            ($period === 'previous' && $this->country_acronym === config('osu.tournament_banner.previous.winner_id'));
    }

    public function period()
    {
        switch ($this->tournament_id) {
            case config('osu.tournament_banner.current.id'):
                return 'current';
            case config('osu.tournament_banner.previous.id'):
                return 'previous';
        }
    }
}
