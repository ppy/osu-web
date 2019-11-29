<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use Carbon\Carbon;

/**
 * @property \Illuminate\Database\Eloquent\Collection $builds Build
 * @property \Illuminate\Database\Eloquent\Collection $changelogEntries ChangelogEntry
 * @property \Illuminate\Database\Eloquent\Collection $changelogs Changelog
 * @property string $name
 * @property string|null $pretty_name
 * @property string|null $repository
 * @property int $stream_id
 */
class UpdateStream extends Model
{
    public $timestamps = false;

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
        return $this->hasManyThrough(ChangelogEntry::class, Repository::class);
    }

    public function scopeWhereHasBuilds($query)
    {
        $query->whereHas('builds', function ($q) {
            $buildInstance = new Build;
            $table = $buildInstance->getTable();
            $database = $buildInstance->dbName();
            $qualifiedTable = "{$database}.{$table}";

            $q->from($qualifiedTable)->default()->whereRaw("{$qualifiedTable}.stream_id = stream_id");
        });
    }

    public function createBuild()
    {
        $entryIds = model_pluck(
            $this->changelogEntries()->orphans($this->getKey()),
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
        return $this->getKey() === config('osu.changelog.featured_stream');
    }
}
