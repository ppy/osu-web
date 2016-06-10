<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Illuminate\Database\Eloquent\Model;

class Beatmap extends Model
{
    protected $table = 'osu_beatmaps';
    protected $primaryKey = 'beatmap_id';

    protected $casts = [
        'orphaned' => 'boolean',
    ];

    protected $dates = ['last_update'];
    public $timestamps = false;

    protected $hidden = ['checksum', 'filename', 'orphaned'];

    public function mods()
    {
        return $this->hasMany(Mod::class, 'beatmap_id', 'beatmap_id');
    }

    const MODES = [
        'osu' => 0,
        'taiko' => 1,
        'fruits' => 2,
        'mania' => 3,
    ];

    public static function modeInt($str)
    {
        return static::MODES[$str] ?? null;
    }

    public static function modeStr($int)
    {
        return array_search_null($int, static::MODES);
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
    }

    public function creator()
    {
        return $this->parent->user();
    }

    public function difficulty()
    {
        return $this->hasMany(BeatmapDifficulty::class);
    }

    public function difficultyAttribs()
    {
        return $this->hasMany(BeatmapDifficultyAttrib::class);
    }

    public function getModeAttribute()
    {
        return static::modeStr($this->playmode);
    }

    public function scopeDefault($query)
    {
        return $query
            ->orderBy('playmode', 'ASC')
            ->orderBy('difficultyrating', 'ASC');
    }

    public function failtimes()
    {
        return $this->hasMany(BeatmapFailtimes::class);
    }

    public function scores()
    {
        $mode = studly_case($this->modeStr($this->playmode));

        return $this->hasMany("App\Models\Score\\{$mode}");
    }

    public function scoresBest()
    {
        $mode = studly_case($this->modeStr($this->playmode));

        return $this->hasMany("App\Models\Score\Best\\{$mode}");
    }
}
