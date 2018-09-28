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

use DB;

class KudosuHistory extends Model
{
    protected $table = 'osu_kudos_exchange';
    protected $primaryKey = 'exchange_id';
    protected $casts = [
        'details' => 'array',
    ];

    protected $dates = ['date'];
    public $timestamps = false;

    public function giver()
    {
        return $this->belongsTo(User::class, 'giver_id', 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Forum\Post::class, 'post_id', 'post_id');
    }

    public function kudosuable()
    {
        return $this->morphTo();
    }

    public function scopeWithPost($query)
    {
        $postTableName = (new Forum\Post)->getTable();
        $thisTableName = $this->getTable();

        return $query->whereExists(function ($query) use ($postTableName, $thisTableName) {
            $query->select(DB::raw(1))
                ->from($postTableName)
                ->whereRaw("{$postTableName}.post_id = {$thisTableName}.post_id");
        });
    }

    public function scopeWithGiver($query)
    {
        $userTableName = (new User)->getTable();
        $thisTableName = $this->getTable();

        return $query->whereExists(function ($query) use ($userTableName, $thisTableName) {
            $query->select(DB::raw(1))
                ->from($userTableName)
                ->whereRaw("{$userTableName}.user_id = {$thisTableName}.giver_id");
        });
    }
}
