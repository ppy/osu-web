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

class BeatmapMirror extends Model
{
    protected $table = 'osu_mirrors';
    protected $primaryKey = 'mirror_id';

    public $timestamps = false;

    protected $hidden = ['secret_key'];

    const MIN_VERSION_TO_USE = 2;

    public function scopeForRegion($query, $region = null)
    {
        return $query
            ->where('regions', 'like', "%$region%");
    }

    public function scopeRandomUsable($query)
    {
        return $query
            ->where('enabled', 1)
            ->where('version', '>=', self::MIN_VERSION_TO_USE)
            ->inRandomOrder();
    }

    public static function getRandom()
    {
        return self::randomUsable()->first();
    }

    public static function getRandomForRegion($region = null)
    {
        if (presence($region)) {
            $regionalMirror = self::forRegion($region)->randomUsable()->first();
        }

        return isset($regionalMirror) ? $regionalMirror : self::getRandom();
    }

    public function generateURL(Beatmapset $beatmapset, $skipVideo = false)
    {
        if ($beatmapset->download_disabled) {
            return false;
        }

        $noVideo = $skipVideo ? '1' : '0';
        $diskFilename = $beatmapset->filename;
        $serveFilename = "{$beatmapset->beatmapset_id} {$beatmapset->artist} - {$beatmapset->title}";
        if ($skipVideo) {
            $serveFilename .= ' [no video]';
        }
        $serveFilename .= '.osz';
        $serveFilename = str_replace(['"', '?'], ['', ''], $serveFilename);

        $time = time();
        $checksum = md5("{$beatmapset->beatmapset_id}{$diskFilename}{$serveFilename}{$time}{$noVideo}{$this->secret_key}");

        $url = "{$this->base_url}d/{$beatmapset->beatmapset_id}?fs=".rawurlencode($serveFilename).'&fd='.rawurlencode($diskFilename)."&ts=$time&cs=$checksum&u=0&nv=$noVideo";

        return $url;
    }
}
