<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property string|null $build
 * @property string $category
 * @property int $changelog_id
 * @property string $checksum
 * @property \Carbon\Carbon $date
 * @property Build $gameBuild
 * @property bool $major
 * @property string $message
 * @property string $prefix
 * @property bool $private
 * @property int|null $stream_id
 * @property int|null $thread_id
 * @property int $tweet
 * @property UpdateStream $updateStream
 * @property string|null $url
 * @property User $user
 * @property int $user_id
 */
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
        return $this->belongsTo(UpdateStream::class, 'stream_id');
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
            'message' => osu_trans('changelog.generic'),
        ]);

        return $change;
    }
}
