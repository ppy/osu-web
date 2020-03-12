<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Cache;
use DB;

/**
 * @property string $code
 * @property int $display_on_posting
 * @property string $emotion
 * @property int $smiley_height
 * @property int $smiley_id
 * @property int $smiley_order
 * @property string $smiley_url
 * @property int $smiley_width
 */
class Smiley extends Model
{
    protected $table = 'phpbb_smilies';

    public static function getAll()
    {
        return Cache::rememberForever('smilies', function () {
            return self::orderBy(DB::raw('LENGTH(code)'), 'desc')->get()->toArray();
        });
    }
}
