<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use InvalidArgumentException;

/**
 * @property Build $build
 * @property mixed $disk_md5
 * @property mixed $mac_md5
 * @property mixed $osu_md5
 * @property \Carbon\Carbon $timestamp
 * @property mixed $unique_md5
 * @property int $user_id
 * @property int $verified
 */
class UserClient extends Model
{
    const CREATED_AT = 'timestamp';

    protected $casts = [
        'verified' => 'boolean',
    ];

    protected $table = 'osu_user_security';

    protected $dates = ['timestamp'];

    protected $primaryKeys = ['user_id', 'osu_md5', 'unique_md5'];

    public $incrementing = false;
    public $timestamps = false;

    public static function lookupOrNew($userId, $hash)
    {
        $splitHash = static::splitHash($hash);

        if ($splitHash === null) {
            return;
        }

        return static::firstOrNew([
            'user_id' => $userId,
            'unique_md5' => $splitHash['unique'],
            'osu_md5' => $splitHash['osu'],
        ], [
            'mac_md5' => $splitHash['mac'],
            'disk_md5' => $splitHash['disk'],
        ]);
    }

    public static function splitHash($hash)
    {
        $hashes = explode(':', $hash);

        if (count($hashes) < 5) {
            return;
        }

        try {
            return array_map(function ($value) {
                if (!ctype_xdigit($value) || strlen($value) !== 32) {
                    throw new InvalidArgumentException('not a valid md5 hash');
                }

                return hex2bin($value);
            }, [
                'osu' => $hashes[0],
                'mac' => $hashes[2],
                'unique' => $hashes[3],
                'disk' => $hashes[4],
            ]);
        } catch (InvalidArgumentException $e) {
            // return nothing on error
        }
    }

    public function build()
    {
        return $this->belongsTo(Build::class, 'osu_md5', 'hash');
    }

    public function isLatest()
    {
        if ($this->build === null) {
            return false;
        }

        $latestBuild = Build::select('build_id')
            ->where([
                'test_build' => false,
                'stream_id' => $this->build->stream_id,
            ])->last();

        return $this->build->getKey() === optional($latestBuild)->getKey();
    }
}
