<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property bool $build_on_tag
 * @property \Illuminate\Database\Eloquent\Collection $changelogEntries ChangelogEntry
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $default_category
 * @property int $id
 * @property UpdateStream $mainUpdateStream
 * @property string $name
 * @property int|null $stream_id
 * @property \Carbon\Carbon|null $updated_at
 */
class Repository extends Model
{
    protected $casts = [
        'build_on_tag' => 'boolean',
    ];

    public static function importFromGithub($data)
    {
        return static::firstOrCreate(['name' => $data['full_name']]);
    }

    public function mainUpdateStream()
    {
        return $this->belongsTo(UpdateStream::class, 'stream_id');
    }

    public function updateStreams()
    {
        $bridgeTable = config('database.connections.mysql.database').'.repository_update_stream';

        return $this->belongsToMany(UpdateStream::class, $bridgeTable, null, 'stream_id');
    }

    public function changelogEntries()
    {
        return $this->hasMany(ChangelogEntry::class);
    }

    public function shortName()
    {
        return substr($this->name, 1 + strpos($this->name, '/'));
    }
}
