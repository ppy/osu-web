<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Auth;

/**
 * @property string $base_url
 * @property int|null $disk_space_free
 * @property int $enabled
 * @property int $mirror_id
 * @property string $pending_purge
 * @property int $perform_updates
 * @property int $provider_user_id
 * @property string|null $regions
 * @property string $secret_key
 * @property int $traffic_limit
 * @property int $traffic_used
 * @property float|null $version
 */
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
        return self::where('regions', null)->randomUsable()->first();
    }

    public static function getRandomFromList(array $mirrorIds)
    {
        return self::whereIn('mirror_id', $mirrorIds)->randomUsable()->first();
    }

    public static function getRandomForRegion($region = null)
    {
        if (presence($region)) {
            $regionalMirror = self::forRegion($region)->randomUsable()->first();
        }

        return $regionalMirror ?? self::getRandom();
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
        $userId = Auth::check() ? Auth::user()->user_id : 0;
        $checksum = md5("{$beatmapset->beatmapset_id}{$diskFilename}{$serveFilename}{$time}{$noVideo}{$this->secret_key}");

        $url = "{$this->base_url}d/{$beatmapset->beatmapset_id}?fs=".rawurlencode($serveFilename).'&fd='.rawurlencode($diskFilename)."&ts=$time&cs=$checksum&nv=$noVideo";

        return $url;
    }
}
