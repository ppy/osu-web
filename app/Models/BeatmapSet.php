<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Request;
use Es;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Libraries\StorageAuto;
use App\Exceptions\BeatmapProcessorException;

class BeatmapSet extends Model
{
    protected $_storage = null;
    protected $table = 'osu_beatmapsets';
    protected $primaryKey = 'beatmapset_id';

    protected $casts = [
        'active' => 'boolean',
        'approved' => 'integer',
        'approvedby_id' => 'integer',
        'beatmapset_id' => 'integer',
        'bpm' => 'float',
        'download_disabled' => 'boolean',
        'epilepsy' => 'boolean',
        'favourite_count' => 'integer',
        'filesize' => 'integer',
        'filesize_novideo' => 'integer',
        'genre_id' => 'integer',
        'language_id' => 'integer',
        'offset' => 'integer',
        'play_count' => 'integer',
        'rating' => 'float',
        'star_priority' => 'integer',
        'storyboard' => 'boolean',
        'thread_id' => 'integer',
        'user_id' => 'integer',
        'versions_available' => 'integer',
        'video' => 'boolean',
    ];

    protected $dates = [
        'approved_date',
        'last_update',
        'submit_date',
        'thread_icon_date',
        'cover_updated_at',
    ];

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

    protected $fillable = [
        'cover_updated_at',
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

    public function scopeRankedOrApproved($query)
    {
        return $query->whereIn('approved', [static::RANKED, static::APPROVED]);
    }

    public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    // one-time checks

    public function isGraveyard()
    {
        return $this->approved === static::GRAVEYARD;
    }

    public function isWIP()
    {
        return $this->approved === static::WIP;
    }

    public function isPending()
    {
        return $this->approved === static::PENDING;
    }

    public function isRanked()
    {
        return $this->approved === static::RANKED;
    }

    public function isApproved()
    {
        return $this->approved === static::APPROVED;
    }

    public function isQualified()
    {
        return $this->approved === static::QUALIFIED;
    }

    private static function sanitizeSearchParams(array &$params = [])
    {
        // sort param
        if (count($params['sort']) !== 2) {
            $params['sort'] = ['ranked', 'desc'];
        }

        $valid_sort_fields = ['title', 'artist', 'creator', 'difficulty', 'ranked', 'rating', 'plays'];
        $valid_sort_orders = ['asc', 'desc'];
        if (!in_array($params['sort'][0], $valid_sort_fields, true) || !in_array($params['sort'][1], $valid_sort_orders, true)) {
            $params['sort'] = ['ranked', 'desc'];
        }

        // remap sort field to their db/elastic-search equivalents
        $params['sort'][0] = str_replace(
            ['difficulty', 'ranked', 'plays'],
            ['difficultyrating', 'approved_date', 'playcount'],
            $params['sort'][0]
        );

        list($params['sort_field'], $params['sort_order']) = $params['sort'];
        unset($params['sort']);

        $valid_ranks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];
        foreach ($params['rank'] as $rank) {
            if (!in_array($rank, $valid_ranks, true)) {
                unset($params['rank'][$rank]);
            }
        }

        if ($params['query'] !== null) {
            $params['query'] = preg_replace('/\s{2,}/', ' ', $params['query']);
            $params['query'] = trim($params['query']);

            $query_parts = explode(' ', $params['query']);
            foreach ($query_parts as $key => $value) {
                $query_parts[$key] = urlencode($value);
            }
            $params['query'] = implode(' AND ', $query_parts);
        }
    }

    public static function searchES(array $params = [])
    {
        extract($params);
        $count = config('osu.beatmaps.max', 50);
        $offset = (max(0, $page - 1)) * $count;

        $searchParams['index'] = env('ES_INDEX', 'osu');
        $searchParams['type'] = 'beatmaps';
        $searchParams['size'] = $count;
        $searchParams['from'] = $offset;
        $searchParams['body']['sort'] = [$sort_field => ['order' => $sort_order]];
        $searchParams['fields'] = ['id'];
        $matchParams = [];

        if (presence($genre) !== null) {
            $matchParams[] = ['match' => ['genre_id' => (int) $genre]];
        }

        if (presence($language) !== null) {
            $matchParams[] = ['match' => ['language_id' => (int) $language]];
        }

        if (is_array($extra) && !empty($extra)) {
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

        if (presence($query) !== null) {
            $matchParams[] = ['query_string' => ['query' => $query]];
        }

        if (!empty($rank)) {
            $klass = presence($mode) !== null ? Score\Best\Model::getClass(intval($mode)) : Score\Best\Combined::class;
            $scores = $klass::forUser(Auth::user())->whereIn('rank', $rank)->get()->lists('beatmapset_id');
            $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $scores]];
        }

        if (presence($mode) !== null && presence($rank) === null) {
            $matchParams[] = ['match' => ['playmode' => (int) $mode]];
        }

        if (!empty($matchParams)) {
            $searchParams['body']['query']['bool']['must'] = $matchParams;
        }

        try {
            $results = Es::search($searchParams);
            $beatmap_ids = array_map(
                function ($e) {
                    return $e['_id'];
                },
                $results['hits']['hits']
            );
        } catch (\Exception $e) {
            $beatmap_ids = [];
        }

        return $beatmap_ids;
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
            'rank' => [],
            'page' => 1,
            'sort' => ['ranked', 'desc'],
        ];

        self::sanitizeSearchParams($params);

        $beatmap_ids = self::searchES($params);
        $beatmaps = [];

        if (count($beatmap_ids) > 0) {
            $ids = implode(',', $beatmap_ids);
            $beatmaps = self::whereIn('beatmapset_id', $beatmap_ids)->orderByRaw(DB::raw("FIELD(beatmapset_id, {$ids})"))->get();
        }

        return $beatmaps;
    }

    public static function listing()
    {
        return self::search();
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
                break;

            case 'faves':
                return $query->faves();
                break;

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

    public function allImageURLs()
    {
        $return = [];

        $shapes = ['cover', 'card', 'list'];
        $scales = ['', '@2x'];
        foreach ($shapes as $shape) {
            foreach ($scales as $scale) {
                $return["$shape$scale"] = $this->coverImageURL("$shape$scale");
            }
        }
        return $return;
    }

    public function coverImageURL($cover_size = 'cover')
    {
        // todo: should probably move these out into their own model, i.e. BeatmapSetCover or something
        $validSizes = ['raw', 'fullsize'];
        $shapes = ['cover', 'card', 'list'];
        $scales = ['', '@2x'];
        foreach ($shapes as $shape) {
            foreach ($scales as $scale) {
                array_push($validSizes, "$shape$scale");
            }
        }
        if (!in_array($cover_size, $validSizes, true)) {
            return false;
        }

        $timestamp = 0;
        if ($this->cover_updated_at) {
            $timestamp = $this->cover_updated_at->format('U');
        }

        return $this->storage()->url("/beatmaps/{$this->beatmapset_id}/covers/{$cover_size}.jpg?{$timestamp}");
    }

    public function storage()
    {
        if ($this->_storage === null) {
            $this->_storage = StorageAuto::get();
        }

        return $this->_storage;
    }

    // todo: generalize method
    public function oszDownloadURL($noVideo = 1)
    {
        $mirrors = config('osu.beatmap_processor.mirrors_to_use');
        $mirror = BeatmapMirror::find($mirrors[array_rand($mirrors)]);

        $diskFilename = $serveFilename = $this->filename;
        $time = time();
        $checksum = md5("{$this->beatmapset_id}{$diskFilename}{$serveFilename}{$time}{$noVideo}{$mirror->secret_key}");

        $url = "{$mirror->base_url}d/{$this->beatmapset_id}?fs=".rawurlencode($serveFilename).'&fd='.rawurlencode($diskFilename)."&ts=$time&cs=$checksum&u=0&nv=$noVideo";

        return $url;
    }

    public function regenerateCovers()
    {
        $time = time();

        $tmpBase = sys_get_temp_dir()."/bm/$this->beatmapset_id/$time";
        $osz = "$tmpBase/$this->beatmapset_id.zip";
        $workingFolder = "$tmpBase/working";
        $outputFolder = "$tmpBase/out";

        // make our temp folders if they don't exist
        if (!is_dir($workingFolder)) {
            mkdir($workingFolder, 0755, true);
        }
        if (!is_dir($outputFolder)) {
            mkdir($outputFolder, 0755, true);
        }

        // download and extract beatmap
        $ok = copy($this->oszDownloadURL(), $osz);
        if (!$ok) {
            throw new BeatmapProcessorException('Error retrieving beatmap');
        }
        $zip = new \ZipArchive;
        $zip->open($osz);
        $zip->extractTo($workingFolder);
        $zip->close();

        // grab the first beatmap (as per old implementation) and scan for background image
        $beatmap = $this->beatmaps()->first();
        $beatmapFilename = $beatmap->filename;
        $bg = $this::scanBMForBG("$workingFolder/$beatmapFilename");
        $bg = str_replace('\\', '/', $bg); // windows pathing woo
        if (!$bg) {
            $this->update(['cover_updated_at' => $this->freshTimestamp()]);
            return false;
        }

        $bg_file = ci_file_search("{$workingFolder}/{$bg}");
        if (!$bg_file) {
            throw new BeatmapProcessorException('Background image missing');
        }

        // upload original image
        $this->storage()->put("/beatmaps/{$this->beatmapset_id}/covers/raw.jpg", file_get_contents($bg_file));
        $originalImage = preg_replace("/https?:\/\//", '', $this->coverImageURL('raw'));

        // upload optimized version
        $resizerEndpoint = config('osu.beatmap_processor.thumbnailer');
        $optimizedImage = preg_replace("/https?:\/\//", '', $this->coverImageURL('fullsize'));

        $ok = copy("$resizerEndpoint/optim/$originalImage", "$outputFolder/fullsize.jpg");
        if (!$ok || filesize("$outputFolder/fullsize.jpg") < 100) {
            throw new BeatmapProcessorException('Error retrieving optimized image.');
        }
        $this->storage()->put("/beatmaps/{$this->beatmapset_id}/covers/fullsize.jpg", file_get_contents("$outputFolder/fullsize.jpg"));

        // use thumbnailer to generate and upload all our variants
        $shapes = ['cover', 'card', 'list'];
        $scales = ['', '@2x'];
        foreach ($shapes as $shape) {
            foreach ($scales as $scale) {
                $ok = copy("$resizerEndpoint/thumb/$shape$scale/$optimizedImage", "$outputFolder/$shape$scale.jpg");
                if (!$ok || filesize("$outputFolder/$shape$scale.jpg") < 100) {
                    throw new BeatmapProcessorException('Error retrieving resized image.');
                }
                $this->storage()->put("/beatmaps/{$this->beatmapset_id}/covers/$shape$scale.jpg", file_get_contents("$outputFolder/$shape$scale.jpg"));
            }
        }

        // clean up after ourselves
        deltree($tmpBase);

        $this->update(['cover_updated_at' => $this->freshTimestamp()]);

        return true;
    }

    // todo: maybe move this somewhere else (copypasta from old implementation)
    public function scanBMForBG($beatmapFilename)
    {
        $content = file_get_contents($beatmapFilename);
        if (!$content) {
            return false;
        }
        $matching = false;
        $image = '';
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($matching) {
                $parts = explode(',', $line);
                if (count($parts) > 2 && $parts[0] === '0') {
                    $image = str_replace('"', '', $parts[2]);
                    break;
                }
            }
            if ($line === '[Events]') {
                $matching = true;
            }
            if ($line === '[HitObjects]') {
                break;
            }
        }

        return $image;
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
        return $this->hasMany(Beatmap::class, 'beatmapset_id');
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

    public function coverUrl()
    {
        return "https://b.ppy.sh/thumb/{$this->beatmapset_id}l.jpg";
    }
}
