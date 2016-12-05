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

use App\Exceptions\BeatmapProcessorException;
use App\Libraries\ImageProcessorService;
use App\Libraries\StorageWithUrl;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Transformers\BeatmapsetTransformer;
use Auth;
use Carbon\Carbon;
use DB;
use Es;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Beatmapset extends Model
{
    protected $_storage = null;
    protected $table = 'osu_beatmapsets';
    protected $primaryKey = 'beatmapset_id';

    protected $casts = [
        'active' => 'boolean',
        'download_disabled' => 'boolean',
        'epilepsy' => 'boolean',
        'storyboard' => 'boolean',
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

    const STATES = [
        'graveyard' => -2,
        'wip' => -1,
        'pending' => 0,
        'ranked' => 1,
        'approved' => 2,
        'qualified' => 3,
        'loved' => 4,
    ];

    const NOMINATIONS_PER_DAY = 1;
    const QUALIFICATIONS_PER_DAY = 6;

    private $_favourites = null;

    // ranking functions for the set

    public function beatmapsetDiscussion()
    {
        return $this->hasOne(BeatmapsetDiscussion::class, 'beatmapset_id', 'beatmapset_id');
    }

    // Beatmapset::rankable();

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
    | use with the query builder. Beatmapset::all()->unranked()
    |
    */

    public function scopeGraveyard($query)
    {
        return $query->where('approved', '=', self::STATES['graveyard']);
    }

    public function scopeWip($query)
    {
        return $query->where('approved', '=', self::STATES['wip']);
    }

    public function scopeUnranked($query)
    {
        return $query->where('approved', '=', self::STATES['pending']);
    }

    public function scopeRanked($query)
    {
        return $query->where('approved', '=', self::STATES['ranked']);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '=', self::STATES['approved']);
    }

    public function scopeQualified($query)
    {
        return $query->where('approved', '=', self::STATES['qualified']);
    }

    public function scopeRankedOrApproved($query)
    {
        return $query->whereIn('approved', [self::STATES['ranked'], self::STATES['approved']]);
    }

    public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    // one-time checks

    public function isGraveyard()
    {
        return $this->approved === self::STATES['graveyard'];
    }

    public function isWIP()
    {
        return $this->approved === self::STATES['wip'];
    }

    public function isPending()
    {
        return $this->approved === self::STATES['pending'];
    }

    public function isRanked()
    {
        return $this->approved === self::STATES['ranked'];
    }

    public function isApproved()
    {
        return $this->approved === self::STATES['approved'];
    }

    public function isQualified()
    {
        return $this->approved === self::STATES['qualified'];
    }

    private static function sanitizeSearchParams(array &$params = [])
    {
        // sort param
        if (count($params['sort']) !== 2) {
            $params['sort'] = ['ranked', 'desc'];
        }

        if (!in_array((int) $params['mode'], Beatmap::MODES, true)) {
            $params['mode'] = null;
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
        $current_user = Auth::user();

        $searchParams = [
            'index' => config('osu.elasticsearch.index'),
            'type' => 'beatmaps',
            'size' => $count,
            'from' => $offset,
            'body' => [
                'sort' => [
                    $sort_field => ['order' => $sort_order],
                ],
            ],
            'fields' => 'id',
        ];

        $matchParams = [];
        $shouldParams = [];

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
            $scores = model_pluck($klass::forUser($current_user)->whereIn('rank', $rank), 'beatmapset_id');
            $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $scores]];
        }

        // TODO: This logic probably shouldn't be at the model level... maybe?
        if (presence($status) !== null) {
            switch ((int) $status) {
                case 0: // Ranked & Approved
                    $shouldParams[] = [
                        ['match' => ['approved' => self::STATES['ranked']]],
                        ['match' => ['approved' => self::STATES['approved']]],
                    ];
                    break;
                case 1: // Approved
                    $matchParams[] = ['match' => ['approved' => self::STATES['approved']]];
                    break;
                case 8: // Loved
                    $matchParams[] = ['match' => ['approved' => self::STATES['loved']]];
                    break;
                case 2: // Favourites
                    $favs = model_pluck($current_user->favouriteBeatmapsets(), 'beatmapset_id');
                    $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $favs]];
                    break;
                case 3: // Mod Requests
                    $maps = model_pluck(ModQueue::select(), 'beatmapset_id');
                    $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $maps]];
                    $matchParams[] = ['match' => ['approved' => self::STATES['pending']]];
                    break;
                case 4: // Pending
                    $shouldParams[] = [
                        ['match' => ['approved' => self::STATES['wip']]],
                        ['match' => ['approved' => self::STATES['pending']]],
                    ];
                    break;
                case 5: // Graveyard
                    $matchParams[] = ['match' => ['approved' => self::STATES['graveyard']]];
                    break;
                case 6: // My Maps
                    $maps = model_pluck($current_user->beatmapsets(), 'beatmapset_id');
                    $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $maps]];
                    break;
                case 7: // Explicit Any
                    break;
                default: // null, etc
                    break;
            }
        } else {
            $matchParams[] = ['range' => ['approved' => ['gte' => self::STATES['pending']]]];
        }

        if (presence($mode) !== null) {
            $matchParams[] = ['match' => ['playmode' => (int) $mode]];
        }

        if (!empty($matchParams)) {
            $searchParams['body']['query']['bool']['must'] = $matchParams;
        }

        if (!empty($shouldParams)) {
            $searchParams['body']['query']['bool']['should'] = $shouldParams;
            $searchParams['body']['query']['bool']['minimum_should_match'] = 1;
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

    public static function searchDB(array $params = [])
    {
        extract($params);

        $count = config('osu.beatmaps.max', 50);
        $offset = max(0, $page - 1) * $count;

        $query = self::where('title', 'like', '%'.$query.'%');

        if ($mode) {
            $query = $query->whereHas('beatmaps', function ($query) use (&$mode) {
                $query->where('playmode', '=', $mode);
            });
        }

        if ($genre) {
            $query->where('genre_id', '=', $genre);
        }

        if ($language) {
            $query->where('language_id', '=', $language);
        }

        if ($extra) {
            foreach ($extra as $val) {
                if ($val === '0') {
                    $query->where('video', '=', 1);
                }

                if ($val === '1') {
                    $query->where('storyboard', '=', 1);
                }
            }
        }

        return $query->take($count)->skip($offset)
            ->orderBy($sort_field, $sort_order)
            ->get()->pluck('beatmapset_id')->toArray();
    }

    public static function search(array $params = [])
    {
        // default search params
        $params += [
            'query' => null,
            'mode' => null,
            'status' => 0,
            'genre' => null,
            'language' => null,
            'extra' => null,
            'rank' => [],
            'page' => 1,
            'sort' => ['ranked', 'desc'],
        ];

        self::sanitizeSearchParams($params);

        if (empty(config('elasticsearch.hosts'))) {
            $beatmap_ids = self::searchDB($params);
        } else {
            $beatmap_ids = self::searchES($params);
        }

        $beatmaps = [];

        if (count($beatmap_ids) > 0) {
            $ids = implode(',', $beatmap_ids);
            $beatmaps = static
                ::with('beatmaps')
                ->whereIn('beatmapset_id', $beatmap_ids)
                ->orderByRaw(DB::raw("FIELD(beatmapset_id, {$ids})"))
                ->get();
        }

        return $beatmaps;
    }

    public static function listing()
    {
        return self::search();
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

    public static function coverSizes()
    {
        $shapes = ['cover', 'card', 'list'];
        $scales = ['', '@2x'];

        $sizes = [];
        foreach ($shapes as $shape) {
            foreach ($scales as $scale) {
                $sizes[] = "$shape$scale";
            }
        }

        return $sizes;
    }

    public function allCoverURLs()
    {
        $urls = [];
        foreach (self::coverSizes() as $size) {
            $urls[$size] = $this->coverURL($size);
        }

        return $urls;
    }

    public static function isValidCoverSize($coverSize)
    {
        $validSizes = array_merge(['raw', 'fullsize'], self::coverSizes());

        return in_array($coverSize, $validSizes, true);
    }

    public function coverURL($coverSize = 'cover')
    {
        if (!self::isValidCoverSize($coverSize)) {
            return false;
        }

        $timestamp = 0;
        if ($this->cover_updated_at) {
            $timestamp = $this->cover_updated_at->format('U');
        }

        return $this->storage()->url($this->coverPath()."{$coverSize}.jpg?{$timestamp}");
    }

    public function coverPath()
    {
        return "/beatmaps/{$this->beatmapset_id}/covers/";
    }

    public function storeCover($target_filename, $source_path)
    {
        $this->storage()->put($this->coverPath().$target_filename, file_get_contents($source_path));
    }

    public function previewURL()
    {
        return '//b.ppy.sh/preview/'.$this->beatmapset_id.'.mp3';
    }

    public function storage()
    {
        if ($this->_storage === null) {
            $this->_storage = new StorageWithUrl();
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
        $tmpBase = sys_get_temp_dir()."/bm/{$this->beatmapset_id}-".time();
        $workingFolder = "$tmpBase/working";
        $outputFolder = "$tmpBase/out";

        try {
            // make our temp folders if they don't exist
            if (!is_dir($workingFolder)) {
                mkdir($workingFolder, 0755, true);
            }
            if (!is_dir($outputFolder)) {
                mkdir($outputFolder, 0755, true);
            }

            // download and extract beatmap
            $osz = "$tmpBase/osz.zip";
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
            $bgFilename = self::scanBMForBG("$workingFolder/$beatmapFilename");

            if (!$bgFilename) {
                $this->update(['cover_updated_at' => $this->freshTimestamp()]);

                return;
            }

            $bgFile = ci_file_search("{$workingFolder}/{$bgFilename}");
            if (!$bgFile) {
                throw new BeatmapProcessorException("Background image missing: {$bgFile}");
            }

            $processor = new ImageProcessorService($tmpBase);

            // upload original image
            $this->storeCover('raw.jpg', $bgFile);

            // upload optimized version
            $optimized = $processor->optimize($this->coverURL('raw'));
            $this->storeCover('fullsize.jpg', $optimized);

            // use thumbnailer to generate and upload all our variants
            foreach (self::coverSizes() as $size) {
                $resized = $processor->resize($this->coverURL('fullsize'), $size);
                $this->storeCover("$size.jpg", $resized);
            }

            $this->update(['cover_updated_at' => $this->freshTimestamp()]);
        } finally {
            // clean up after ourselves
            deltree($tmpBase);
        }
    }

    // todo: maybe move this somewhere else (copypasta from old implementation)
    public function scanBMForBG($beatmapFilename)
    {
        $content = file_get_contents($beatmapFilename);
        if (!$content) {
            return false;
        }
        $matching = false;
        $imageFilename = '';
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($matching) {
                $parts = explode(',', $line);
                if (count($parts) > 2 && $parts[0] === '0') {
                    $imageFilename = str_replace('"', '', $parts[2]);
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

        // older beatmaps may not have sanitized paths
        $imageFilename = str_replace('\\', '/', $imageFilename);

        return $imageFilename;
    }

    public function disqualify(User $user, $comment)
    {
        if (!$this->isQualified()) {
            return false;
        }

        DB::transaction(function () use ($user, $comment) {
            $this->events()->create(['type' => BeatmapsetEvent::DISQUALIFY, 'user_id' => $user->user_id, 'comment' => $comment]);
            $this->approved = self::STATES['pending'];
            $this->save();
        });

        return true;
    }

    public function qualify()
    {
        if (!$this->isPending()) {
            return false;
        }

        DB::transaction(function () {
            $this->events()->create(['type' => BeatmapsetEvent::QUALIFY]);
            $this->approved = self::STATES['qualified'];
            $this->approved_date = Carbon::now();
            $this->save();
        });

        return true;
    }

    public function nominate(User $user)
    {
        if (!$this->isPending()) {
            return false;
        }

        DB::transaction(function () use ($user) {
            $nomination = $this->recentEvents()->nominations()->where('user_id', $user->user_id);
            if (!$nomination->exists()) {
                $this->events()->create(['type' => BeatmapsetEvent::NOMINATE, 'user_id' => $user->user_id]);
                if ($this->currentNominationCount() >= $this->requiredNominationCount()) {
                    $this->qualify();
                }
            }
        });

        return true;
    }

    public function favourite($user)
    {
        DB::transaction(function () use ($user) {
            try {
                FavouriteBeatmapset::create([
                    'user_id' => $user->user_id,
                    'beatmapset_id' => $this->beatmapset_id,
                ]);
            } catch (QueryException $e) {
                if (is_sql_unique_exception($e)) {
                    return;
                } else {
                    throw $e;
                }
            }

            $this->favourite_count = DB::raw('favourite_count + 1');
            $this->save();
        });
    }

    public function unfavourite($user)
    {
        if (!$this->hasFavourited($user)) {
            return;
        }

        DB::transaction(function () use ($user) {
            $this->favourites()->where('user_id', $user->user_id)
                ->delete();

            $this->favourite_count = DB::raw('GREATEST(favourite_count - 1, 0)');
            $this->save();
        });
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

    public function events()
    {
        return $this->hasMany(BeatmapsetEvent::class);
    }

    public function requiredNominationCount()
    {
        $longest_map_duration = $this->beatmaps->max('total_length');

        return $longest_map_duration > 315 ? 3 : 2;
    }

    public function currentNominationCount()
    {
        return count($this->recentEvents()->nominations()->get());
    }

    public function rankingETA()
    {
        if (!$this->isQualified()) {
            return;
        }

        $queueSize = static::qualified()->where('approved_date', '<', $this->approved_date)->count();
        $days = ceil($queueSize / static::QUALIFICATIONS_PER_DAY);

        return $days > 0 ? Carbon::now()->addDays($days)->startOfDay() : null;
    }

    public function recentEvents()
    {
        // relevant events differ depending on state of beatmapset
        $events = $this->events();
        switch ($this->approved) {
            case self::STATES['pending']:
            case self::STATES['qualified']:
                // last 'disqualify' event (if any) and all events since
                $disqualifyEvent = $this->events()->disqualifications()->orderBy('created_at', 'desc')->first();
                if ($disqualifyEvent) {
                    $events->where('id', '>=', $disqualifyEvent->id);
                }
        }

        return $events;
    }

    public function status()
    {
        return array_search($this->approved, self::STATES, true);
    }

    public function defaultJson($currentUser = null)
    {
        $includes = ['beatmaps', 'nominations'];

        return json_item($this, new BeatmapsetTransformer, $includes);
    }

    public function defaultBeatmaps()
    {
        return $this->hasMany(Beatmap::class, 'beatmapset_id')->default();
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

    public function userRatings()
    {
        return $this->hasMany(BeatmapsetUserRating::class);
    }

    public function ratingsCount()
    {
        $ratings = [];

        for ($i = 0; $i <= 10; $i++) {
            $ratings[$i] = 0;
        }

        $userRatings = $this->userRatings()
            ->select('rating', \DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->get();

        foreach ($userRatings as $rating) {
            $ratings[$rating->rating] = $rating->count;
        }

        return $ratings;
    }

    public function favourites()
    {
        return $this->hasMany(FavouriteBeatmapset::class);
    }

    public function hasFavourited($user)
    {
        return $user === null
            ? false
            : $this->favourites()->where('user_id', $user->user_id)->exists();
    }

    public function description()
    {
        $topic = Topic::find($this->thread_id);

        if ($topic === null) {
            return;
        }

        $post = Post::find($topic->topic_first_post_id);

        // Any description (after the first match) that matches
        // '[-{15}]' within its body doesn't get split anymore,
        // and gets stored in $split[1] anyways
        $split = preg_split('[-{15}]', $post->post_text, 2);

        // Return empty description if the pattern was not found
        // (mostly older beatmapsets)
        $description = $split[1] ?? '';

        return (new \App\Libraries\BBCodeFromDB($description, $post->bbcode_uid, true))->toHTML(true);
    }
}
