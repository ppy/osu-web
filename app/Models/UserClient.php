<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

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

    protected $table = 'osu_user_security';

    protected $dates = ['timestamp'];

    protected $primaryKeys = ['user_id', 'osu_md5', 'unique_md5'];

    public $timestamps = false;

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
