<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

/**
 * @property \Illuminate\Database\Eloquent\Collection $builds Build
 * @property \Illuminate\Database\Eloquent\Collection $changelogEntries ChangelogEntry
 * @property \Illuminate\Database\Eloquent\Collection $changelogs Changelog
 * @property bool $default_allow_bancho
 * @property string $name
 * @property string|null $pretty_name
 * @property string|null $repository
 * @property int $stream_id
 */
class UpdateStream extends Model
{
    public $timestamps = false;

    protected $casts = [
        'default_allow_bancho' => 'boolean',
    ];
    protected $connection = 'mysql-updates';
    protected $table = 'streams';
    protected $primaryKey = 'stream_id';

    public function builds()
    {
        return $this->hasMany(Build::class);
    }

    public function changelogs()
    {
        return $this->hasMany(Changelog::class);
    }

    public function changelogEntries()
    {
        return $this->belongsToMany(
            ChangelogEntry::class,
            Repository::updateStreamBridgeTable(),
            null,
            'repository_id',
            'stream_id',
            'repository_id',
        );
    }

    public function scopeWhereHasBuilds($query)
    {
        $query->whereHas('builds', function ($q) {
            $buildInstance = new Build();
            $table = $buildInstance->getTable();
            $database = $buildInstance->dbName();
            $qualifiedTable = "{$database}.{$table}";

            $q->from($qualifiedTable)->default()->whereRaw("{$qualifiedTable}.stream_id = stream_id");
        });
    }

    public function createBuild()
    {
        $entryIds = model_pluck(
            $this->orphanChangelogEntries(),
            'id',
            ChangelogEntry::class
        );

        if (empty($entryIds)) {
            return;
        }

        $version = Carbon::now()->format('Y.nd.0');
        $build = $this->builds()->firstOrCreate(compact('version'));
        $build->changelogEntries()->attach($entryIds);

        return $build;
    }

    public function orphanChangelogEntries(): Builder
    {
        $query = $this->changelogEntries()->orphans($this->getKey());

        if ($this->parent_id !== null) {
            $query->orphans($this->parent_id);
        }

        return $query;
    }

    public function latestBuild()
    {
        return $this->builds()->orderBy('build_id', 'DESC')->first();
    }

    public function userCount()
    {
        return (int) $this->builds()->where('allow_bancho', '=', true)->sum('users');
    }

    public function isFeatured()
    {
        return $this->getKey() === $GLOBALS['cfg']['osu']['changelog']['featured_stream'];
    }
}
