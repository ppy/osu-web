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

class Changelog extends Model
{
    public $timestamps = false;
    protected $table = 'osu_changelog';
    protected $primaryKey = 'changelog_id';

    protected $casts = [
        'private' => 'boolean',
        'major' => 'boolean',
    ];

    protected $dates = [
        'date',
    ];

    const PREFIXES = [
        'add' => '+',
        'fix' => '*',
        'misc' => '?',
    ];

    public function scopeDefault($query)
    {
        return $query
            ->where('private', 0)
            ->orderBy('date', 'desc')
            ->orderBy('major', 'desc');
    }

    public function scopeListing($query, $offset = 20)
    {
        $limit = config('osu.changelog.max', 20);

        return $query
            ->where('private', 0)
            ->take($limit)
            ->skip($offset)
            ->orderBy('changelog_id', 'desc');
    }

    public function scopeVisibleOnBuilds($query)
    {
        return $query->whereNotIn('category', ['Code', 'Web']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updateStream()
    {
        return $this->hasOne(UpdateStream::class, 'stream_id', 'stream_id');
    }

    public function gameBuild()
    {
        return $this->belongsTo(Build::class, 'build', 'version');
    }

    public function getPrefixAttribute($value)
    {
        return array_search_null($value, static::PREFIXES);
    }

    public static function placeholder()
    {
        $user = new User([
            // not sure if those should be put in config
            'user_id' => 2,
            'username' => 'peppy',
        ]);

        $change = new static([
            'user' => $user,
            'user_id' => $user->user_id,
            'prefix' => '*',
            'message' => trans('changelog.generic'),
        ]);

        return $change;
    }
}
