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
