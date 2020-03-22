<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property mixed $hash
 */
class WeakPassword extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'hash';
    protected $keyType = 'string';

    public static function add($string)
    {
        static::create(['hash' => md5(strtolower($string), true)]);
    }

    public static function check($string)
    {
        return static::where(['hash' => md5(strtolower($string), true)])->exists();
    }
}
