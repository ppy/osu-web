<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

class ProfileBanner extends Model
{
    protected $table = 'osu_profile_banners';
    protected $primaryKey = 'banner_id';
    protected $macros = ['visible'];
    public $timestamps = false;

    protected $fillable = ['tournament_id', 'country_acronym'];

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

    public function macroVisible()
    {
        return function ($query) {
            $last = $query->orderBy('banner_id', 'DESC')->first();

            if ($last !== null && $last->isVisible()) {
                return $last;
            }
        };
    }

    public function image()
    {
        $period = $this->period();

        if ($period !== null) {
            $prefix = config("osu.tournament_support.{$period}.prefix");

            return "{$prefix}{$this->country_acronym}.jpg";
        }
    }

    public function isVisible()
    {
        $period = $this->period();

        return $period === 'current' ||
            ($period === 'previous' && $this->country_acronym === config('osu.tournament_support.previous.winner_id'));
    }

    public function period()
    {
        switch ($this->tournament_id) {
            case config('osu.tournament_support.current.id'):
                return 'current';
            case config('osu.tournament_support.previous.id'):
                return 'previous';
        }
    }
}
