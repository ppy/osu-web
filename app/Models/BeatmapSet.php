<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use Request;
use Es;
use Illuminate\Database\Eloquent\Model;

class BeatmapSet extends Model
{
    protected $table = 'osu_beatmapsets';
    protected $primaryKey = 'beatmapset_id';
    public $timestamps = false;
    protected $hidden = [
        'header_hash',
        'body_hash',
        'download_disabled',
        'download_disabled_url',
        'displaytitle',
        'approvedby_id',
        'difficulty_names',
        'thread_icon_date',
        'thread_id',
    ];

    const GRAVEYARD = -2;
    const WIP = -1;
    const PENDING = 0;
    const RANKED = 1;
    const APPROVED = 2;
    const QUALIFIED = 3;

    // ranking functions for the set

    public function rank(User $user = null)
    {
        $this->setRank(static::RANKED, $user);
    }

    public function pending(User $user = null)
    {
        $this->setRank(static::PENDING, $user);
    }

    public function wip(User $user = null)
    {
        $this->setRank(static::WIP, $user);
    }

    public function approve(User $user = null)
    {
        $this->setRank(static::APPROVED, $user);
    }

    public function qualify(User $user = null)
    {
        $this->setRank(static::QUALIFIED, $user);
    }

    public function graveyard(User $user = null)
    {
        $this->setRank(static::GRAVEYARD, $user);
    }

    protected function setRank($rank, User $user = null)
    {
        $user = $user ?: new User(User::SYSTEM_USER);

        $this->approved_by = $user->user_id;
        $this->approved = $rank;
        $this->save();
    }

    // BeatmapSet::rankable();

    public function scopeRankable($query)
    {
        return $query->qualified()
            ->where('approved_date', '>', DB::raw('date_sub(now(), interval 30 day)'))
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Scope Checker Functions
    |--------------------------------------------------------------------------
    |
    | Checks the approval column, but allows a global filter for
    | use with the query builder. BeatmapSet::all()->unranked()
    |
    */

    public function scopeGraveyard($query)
    {
        return $query->where('approved', '=', static::GRAVEYARD);
    }

    public function scopeWip($query)
    {
        return $query->where('approved', '=', static::WIP);
    }

    public function scopeUnranked($query)
    {
        return $query->where('approved', '=', static::PENDING);
    }

    public function scopeRanked($query)
    {
        return $query->where('approved', '=', static::RANKED);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '=', static::APPROVED);
    }

    public function scopeQualified($query)
    {
        return $query->where('approved', '=', static::QUALIFIED);
    }

    // one-time checks

    public function isGraveyard()
    {
        return $this->approved == static::GRAVEYARD;
    }

    public function isWIP()
    {
        return $this->approved == static::WIP;
    }

    public function isPending()
    {
        return $this->approved == static::PENDING;
    }

    public function isRanked()
    {
        return $this->approved == static::RANKED;
    }

    public function isApproved()
    {
        return $this->approved == static::APPROVED;
    }

    public function isQualified()
    {
        return $this->approved == static::QUALIFIED;
    }

    public static function search(array $params = [])
    {

        // default search params
        $params += [
            'query' => null,
            'mode' => 0,
            'status' => 0,
            'genre' => null,
            'language' => null,
            'extra' => null,
            'rank' => null,
            'page' => 1,
        ];
        extract($params);

        $max = config('osu.beatmaps.max', 30);

        $searchParams['index'] = env('ES_INDEX', 'osu');
        $searchParams['type'] = 'beatmaps';
        $searchParams['size'] = $max;

        $searchParams['from'] = (max(0, $page - 1)) * $max;
        $searchParams['body']['sort'] = ['approved_date' => ['order' => 'desc']];

        $matchParams = [];

        if (presence($mode)) {
            $matchParams[] = ['match' => ['playmode' => (int) $mode]];
        }

        if (presence($genre)) {
            $matchParams[] = ['match' => ['genre_id' => (int) $genre]];
        }

        if (presence($language)) {
            $matchParams[] = ['match' => ['language_id' => (int) $language]];
        }

        if ([$extra] && !empty($extra)) {
            foreach ($extra as $val) {
                switch ($val) {
                    case 0: // video
                        $matchParams[] = ['match' => ['video' => 1]];
                        break;
                    case 1: // storyboard
                        $matchParams[] = ['match' => ['storyboard' => 1]];
                        break;
                }
            }
        }

        if (presence($query)) {
            $matchParams[] = ['query_string' => ['query' => implode(' AND ', explode(' ', $query))]];
        }

        if (!empty($matchParams)) {
            $searchParams['body']['query']['bool']['must'] = $matchParams;
        }

        $listing = Es::search($searchParams);
        $listing = array_map(function ($e) { $e['_source']['beatmapset_id'] = $e['_id'];

return $e['_source']; }, $listing['hits']['hits']);

        return $listing;
    }

    public static function listing()
    {
        $max = config('osu.beatmaps.max', 30);
        $page = Request::input('page', 1) - 1;

        $searchParams['index'] = env('ES_INDEX', 'osu');
        $searchParams['size'] = $max;
        $searchParams['body']['sort'] = ['approved_date' => ['order' => 'desc']];
        $searchParams['type'] = 'beatmaps';

        $listing = Es::search($searchParams);
        $listing = array_map(function ($e) { $e['_source']['beatmapset_id'] = $e['_id'];

return $e['_source']; }, $listing['hits']['hits']);

        return $listing;
    }

    public function scopeSort($query)
    {
        switch (Request::input('sort', 'id')) {
            case 'id':
            default:
                $by = 'desc';
                $order = $this->primaryKey;
                break;
        }

        return $query->orderBy($order, $by);
    }

    public static function mode()
    {
        switch (Request::input('mode', 'all')) {
            case 'osu':
            case Beatmap::OSU:
                $mode = Beatmap::OSU;
                break;

            case 'taiko':
            case Beatmap::TAIKO:
                $mode = Beatmap::TAIKO;
                break;

            case 'ctb':
            case Beatmap::CTB:
                $mode = Beatmap::CTB;
                break;

            case 'mania':
            case Beatmap::MANIA;
                $mode = Beatmap::MANIA;
                break;

            case 'all':
            default:
                return static::with('beatmaps', 'user');
        }

        return static::with(['beatmaps' => function ($query) use ($mode) {
            $query->where('playmode', '=', $mode);
        }], 'user');
    }

    public function scopeFilters($query)
    {
        switch (Request::input('filter')) {
            case 'qualified':
                $filter = static::QUALIFIED;
                break;

            case 'ranked':
                $filter = static::RANKED;
                break;

            case 'approved':
                $filter = static::APPROVED;
                break;

            case 'modreq':
            case 'pending':
                $filter = static::PENDING;
                break;

            case 'all':
                return $query;

            case 'graveyard':
                $filter = static::GRAVEYARD;
                break;

            case 'my-maps':
                if (Auth::check()) {
                    return $query->where('user_id', '=', Auth::user()->user_id);
                }

            case 'faves':
                return $query->faves();

            case 'ranked-approved':
            default:
                return $query->whereIn('approved', [static::RANKED, static::APPROVED]);
        }

        return $query->where('approved', '=', $filter);
    }

    public function comments($time = null)
    {
        $mods = Mod::query()
            ->where('beatmapset_id', '=', $this->beatmapset_id)
            ->whereNull('parent_item_id')
            ->orderBy('created_at', 'desc');

        if ($time) {
            $mods = $mods->where(function ($query) use ($time) {
                $query->where(DB::raw('UNIX_TIMESTAMP(`created_at`)'), '>', $time);
                $query->orWhere(DB::raw('UNIX_TIMESTAMP(`updated_at`)'), '>', $time);
            })
            ->withTrashed();
        }

        $mods = $mods->get()->load('creator');

        $new = [];

        foreach ($mods as $mod) {
            $new[$mod->item_id] = $mod->toArray();
        }

        return $new;
    }

    public function replies($time = null)
    {
        $replies = Mod::query()
                ->whereNotNull('parent_item_id')
                ->where('beatmapset_id', '=', $this->beatmapset_id)
                ->orderBy('created_at', 'asc');

        if ($time) {
            // also grab soft-deleted posts
            $replies = $replies->where(function ($query) use ($time) {
                $query->where(DB::raw('UNIX_TIMESTAMP(`created_at`)'), '>', $time);
                $query->orWhere(DB::raw('UNIX_TIMESTAMP(`updated_at`)'), '>', $time);
            })
            ->withTrashed();
        }

        $replies = $replies->get()->load('creator');

        $new = [];

        foreach ($replies as $reply) {
            if (!isset($new[$reply->parent_item_id])) {
                $new[$reply->parent_item_id] = [];
            }

            $new[$reply->parent_item_id][$reply->item_id] = $reply->toArray();
        }

        return $new;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | One set has many beatmaps, which in turn have many mods
    | One set has a single creator.
    |
    */

    public function beatmaps()
    {
        return $this->hasMany("App\Models\Beatmap", 'beatmapset_id', 'beatmapset_id');
    }

    public function mods()
    {
        return $this->hasMany("App\Models\Mod", 'beatmapset_id', 'beatmapset_id');
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", 'user_id', 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo("App\Models\User", 'user_id', 'approvedby_id');
    }
}
