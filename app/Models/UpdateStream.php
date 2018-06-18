<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

class UpdateStream extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql-updates';
    protected $table = 'streams';
    protected $primaryKey = 'stream_id';

    public function builds()
    {
        return $this->hasMany(Build::class, 'stream_id', 'stream_id');
    }

    public function changelogs()
    {
        return $this->hasMany(Changelog::class, 'stream_id', 'stream_id');
    }

    public function changelogEntries()
    {
        return $this->hasManyThrough(
            ChangelogEntry::class, // target class
            Repository::class, // bridge class
            'stream_id', // column name in bridge linking to this
            'repository', // column name in target linking to bridge
            null, // column name in this linking to bridge
            'name' // column name in bridge linking to target
        );
    }

    public function createBuild()
    {
        $entryIds = model_pluck(
            $this->changelogEntries()->whereDoesntHave('builds'),
            'id',
            ChangelogEntry::class
        );

        if (empty($entryIds)) {
            return;
        }

        $version = Carbon::now()->format('Y.nd.0').$this->name;
        $build = $this->builds()->firstOrCreate(compact('version'));
        $build->changelogEntries()->attach($entryIds);

        return $build;
    }
}
