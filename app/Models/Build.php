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

class Build extends Model
{
    public $timestamps = false;

    protected $table = 'osu_builds';
    protected $primaryKey = 'build_id';

    protected $dates = [
        'date',
    ];

    private $cache = [];

    public function updateStream()
    {
        return $this->belongsTo(UpdateStream::class, 'stream_id', 'stream_id');
    }

    public function changelogs()
    {
        return $this->hasMany(Changelog::class, 'build', 'version');
    }

    public function scopeLatestByStream($query, $streamIds)
    {
        $latestBuildIds = static::selectRaw('MAX(build_id) latest_build_id')
            ->whereIn('stream_id', $streamIds)
            ->groupBy('stream_id')
            ->pluck('latest_build_id');

        $query->whereIn('build_id', $latestBuildIds);
    }

    public function scopePropagationHistory($query)
    {
        return $query->where('allow_bancho', true)
            ->where('test_build', false);
    }

    public function versionNext()
    {
        if (!array_key_exists('versionNext', $this->cache)) {
            $this->cache['versionNext'] = static
                ::where('build_id', '>', $this->build_id)
                ->where('stream_id', $this->stream_id)
                ->orderBy('build_id', 'ASC')
                ->first();
        }

        return $this->cache['versionNext'];
    }

    public function versionPrevious()
    {
        if (!array_key_exists('versionPrevious', $this->cache)) {
            $this->cache['versionPrevious'] = static
                ::where('build_id', '<', $this->build_id)
                ->where('stream_id', $this->stream_id)
                ->orderBy('build_id', 'DESC')
                ->first();
        }

        return $this->cache['versionPrevious'];
    }

    public function displayVersion()
    {
        return preg_replace('#[^0-9.]#', '', $this->version);
    }

    public function disqusId()
    {
        return 'build_b'.substr(htmlentities($this->version), 0, 8).$this->updateStream->name;
    }

    public function disqusTitle()
    {
        return 'Release Notes for b'.$this->displayVersion().' ('.$this->updateStream->pretty_name.')';
    }
}
