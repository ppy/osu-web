<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use DB;

/**
 * @property mixed $action
 * @property int $amount
 * @property \Carbon\Carbon $date
 * @property array|null $details
 * @property int $exchange_id
 * @property User $giver
 * @property int|null $giver_id
 * @property mixed $kudosuable
 * @property int|null $kudosuable_id
 * @property string|null $kudosuable_type
 * @property Forum\Post $post
 * @property int|null $post_id
 * @property User $receiver
 * @property int $receiver_id
 */
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
        $postTableName = (new Forum\Post())->getTable();
        $thisTableName = $this->getTable();

        return $query->whereExists(function ($query) use ($postTableName, $thisTableName) {
            $query->select(DB::raw(1))
                ->from($postTableName)
                ->whereRaw("{$postTableName}.post_id = {$thisTableName}.post_id");
        });
    }

    public function scopeWithGiver($query)
    {
        $userTableName = (new User())->getTable();
        $thisTableName = $this->getTable();

        return $query->whereExists(function ($query) use ($userTableName, $thisTableName) {
            $query->select(DB::raw(1))
                ->from($userTableName)
                ->whereRaw("{$userTableName}.user_id = {$thisTableName}.giver_id");
        });
    }
}
