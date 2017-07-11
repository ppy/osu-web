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

use App\Exceptions\BeatmapProcessorException;
use App\Libraries\ImageProcessorService;
use App\Libraries\StorageWithUrl;
use App\Transformers\BeatmapsetTransformer;
use Cache;
use Carbon\Carbon;
use DB;
use Es;
use Illuminate\Database\QueryException;

class Beatmapset extends Model
{
    protected $_storage = null;
    protected $table = 'osu_beatmapsets';
    protected $primaryKey = 'beatmapset_id';
    protected $guarded = [];

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

    const STATES = [
        'graveyard' => -2,
        'wip' => -1,
        'pending' => 0,
        'ranked' => 1,
        'approved' => 2,
        'qualified' => 3,
        'loved' => 4,
    ];

    const SEARCH_DEFAULTS = [
        'query' => null,
        'mode' => null,
        'sort_order' => 'desc',
        'sort_field' => 'approved_date',
        'rank' => '',
        'status' => 0,
        'genre' => null,
        'language' => null,
        'extra' => '',
        'limit' => 20,
        'page' => 1,
    ];

    const NOMINATIONS_PER_DAY = 1;
    const QUALIFICATIONS_PER_DAY = 6;
    const BUNDLED_IDS = [3756, 163112, 140662, 151878, 190390, 123593, 241526, 299224];

    /*
    |--------------------------------------------------------------------------
    | Accesssors
    |--------------------------------------------------------------------------
    */

    public function getApprovedDateAttribute($value)
    {
        return (new Carbon($value))->subHours(8);
    }

    public function getSubmitDateAttribute($value)
    {
        return (new Carbon($value))->subHours(8);
    }

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

    public function hasScores()
    {
        return $this->attributes['approved'] > 0;
    }

    public static function searchParams(array $params = [])
    {
        // mode
        $params['mode'] = get_int($params['mode'] ?? null);
        if (!in_array($params['mode'], Beatmap::MODES, true)) {
            $params['mode'] = null;
        }

        // sort_order, sort_field (and clear up sort)
        $sort = explode('_', array_pull($params, 'sort'));

        $validSortFields = [
            'artist' => 'artist',
            'creator' => 'creator',
            'difficulty' => 'difficultyrating',
            'plays' => 'playcount',
            'ranked' => 'approved_date',
            'rating' => 'rating',
            'title' => 'title',
        ];
        $params['sort_field'] = $validSortFields[$sort[0] ?? null] ?? 'approved_date';

        $params['sort_order'] = $sort[1] ?? null;
        if (!in_array($params['sort_order'], ['asc', 'desc'], true)) {
            $params['sort_order'] = 'desc';
        }

        // rank
        $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];
        $params['rank'] = array_intersect(explode('.', $params['rank'] ?? null), $validRanks);

        // the rest, oneliner
        $params['query'] = presence($params['query'] ?? null);
        $params['status'] = get_int($params['status'] ?? 0);
        $params['genre'] = get_int($params['genre'] ?? null);
        $params['language'] = get_int($params['language'] ?? null);
        $params['extra'] = explode('.', $params['extra'] ?? null);
        $params['limit'] = clamp(get_int($params['limit'] ?? config('osu.beatmaps.max')), 1, config('osu.beatmaps.max'));
        $params['page'] = max(1, get_int($params['page'] ?? 1));
        $params['offset'] = ($params['page'] - 1) * $params['limit'];

        return $params;
    }

    public static function searchES(array $params = [])
    {
        $searchParams = [
            'index' => config('osu.elasticsearch.index'),
            'type' => 'beatmaps',
            'size' => $params['limit'],
            'from' => $params['offset'],
            'body' => [
                'sort' => [
                    $params['sort_field'] => ['order' => $params['sort_order']],
                ],
            ],
            'fields' => 'id',
        ];

        $matchParams = [];
        $shouldParams = [];

        if ($params['genre'] !== null) {
            $matchParams[] = ['match' => ['genre_id' => $params['genre']]];
        }

        if ($params['language'] !== null) {
            $matchParams[] = ['match' => ['language_id' => $params['language']]];
        }

        if (is_array($params['extra'])) {
            foreach ($params['extra'] as $val) {
                switch ($val) {
                    case 'video':
                        $matchParams[] = ['match' => ['video' => 1]];
                        break;
                    case 'storyboard':
                        $matchParams[] = ['match' => ['storyboard' => 1]];
                        break;
                }
            }
        }

        if (present($params['query'])) {
            $query = es_query_and_words($params['query']);
            $matchParams[] = ['query_string' => ['query' => $query]];
        }

        if (!empty($params['rank'])) {
            if ($params['mode'] !== null) {
                $modes = [$params['mode']];
            } else {
                $modes = array_values(Beatmap::MODES);
            }

            $unionQuery = null;
            foreach ($modes as $mode) {
                $newQuery =
                    Score\Best\Model::getClass($mode)
                    ->forUser($params['user'])
                    ->whereIn('rank', $params['rank'])
                    ->select('beatmapset_id');

                if ($unionQuery === null) {
                    $unionQuery = $newQuery;
                } else {
                    $unionQuery->union($newQuery);
                }
            }

            $scores = model_pluck($unionQuery, 'beatmapset_id');

            $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $scores]];
        }

        switch ($params['status']) {
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
                $favs = model_pluck($params['user']->favouriteBeatmapsets(), 'beatmapset_id');
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
                $maps = model_pluck($params['user']->beatmapsets(), 'beatmapset_id');
                $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $maps]];
                break;
            case 7: // Explicit Any
                break;
            default: // null, etc
                break;
        }

        if ($params['mode'] !== null) {
            $matchParams[] = ['match' => ['playmode' => $params['mode']]];
        }

        if (!empty($matchParams)) {
            $searchParams['body']['query']['bool']['must'] = $matchParams;
        }

        if (!empty($shouldParams)) {
            $searchParams['body']['query']['bool']['should'] = $shouldParams;
            $searchParams['body']['query']['bool']['minimum_should_match'] = 1;
        }

        $results = Es::search($searchParams);
        $beatmapIds = array_map(
            function ($e) {
                return $e['_id'];
            },
            $results['hits']['hits']
        );

        return [
            'ids' => $beatmapIds,
            'total' => $results['hits']['total'],
        ];
    }

    public static function searchDB(array $params = [])
    {
        $query = static::where('title', 'like', '%'.$params['query'].'%');

        if ($params['mode'] !== null) {
            $query->whereHas('beatmaps', function ($query) use ($params) {
                $query->where('playmode', '=', $params['mode']);
            });
        }

        if ($params['genre'] !== null) {
            $query->where('genre_id', '=', $params['genre']);
        }

        if ($params['language'] !== null) {
            $query->where('language_id', '=', $params['language']);
        }

        if (!empty($params['extra'])) {
            foreach ($params['extra'] as $val) {
                switch ($val) {
                    case 'video':
                        $query->where('video', '=', 1);
                        break;
                    case 'storyboard':
                        $query->where('storyboard', '=', 1);
                        break;
                }
            }
        }

        $ids = $query->take($params['limit'])->skip($params['offset'])
            ->orderBy($params['sort_field'], $params['sort_order'])
            ->get()->pluck('beatmapset_id')->toArray();

        $total = $query->count();

        return compact('ids', 'total');
    }

    public static function search(array $params = [])
    {
        $params = static::searchParams($params);

        if (empty(config('elasticsearch.hosts'))) {
            $result = static::searchDB($params);
        } else {
            $result = static::searchES($params);
        }

        $data = count($result['ids']) > 0
            ? static
                ::with('beatmaps')
                ->whereIn('beatmapset_id', $result['ids'])
                ->orderByField('beatmapset_id', $result['ids'])
                ->get()
            : [];

        return [
            'data' => $data,
            'total' => $result['total'],
        ];
    }

    public static function latestRankedOrApproved($count = 5)
    {
        // TODO: add filtering by game mode after mode-toggle UI/UX happens

        return Cache::remember("beatmapsets_latest_{$count}", 60, function () use ($count) {
            // We union here so mysql can use indexes to speed this up
            $ranked = self::ranked()->active()->orderBy('approved_date', 'desc')->limit($count);
            $approved = self::approved()->active()->orderBy('approved_date', 'desc')->limit($count);

            return $ranked->union($approved)->orderBy('approved_date', 'desc')->limit($count)->get();
        });
    }

    public static function mostPlayedToday($mode = 'osu', $count = 5)
    {
        // TODO: this only returns based on osu mode plays for now, add other game modes after mode-toggle UI/UX happens

        return Cache::remember("beatmapsets_most_played_today_{$mode}_{$count}", 60, function () use ($mode, $count) {
            $counts = Score\Osu::selectRaw('beatmapset_id, count(*) as playcount')
                    ->whereNotIn('beatmapset_id', self::BUNDLED_IDS)
                    ->groupBy('beatmapset_id')
                    ->orderBy('playcount', 'desc')
                    ->limit($count)
                    ->get();

            $mostPlayed = [];
            foreach ($counts as $value) {
                $mostPlayed[$value['beatmapset_id']] = $value['playcount'];
            }

            return $mostPlayed;
        });
    }

    public static function listing()
    {
        return static::search()['data'];
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

            if ($bgFile !== false) {
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

    public function setApproved($state, $user)
    {
        $this->approved = static::STATES[$state];

        if ($this->approved > 0) {
            $this->approved_date = Carbon::now();
            $this->approvedby_id = $user->user_id;
        } else {
            $this->approved_date = null;
            $this->approvedby_id = null;
        }

        $this->save();

        $this
            ->beatmaps()
            ->update(['approved' => $this->approved]);
    }

    public function disqualify(User $user, $comment)
    {
        if (!$this->isQualified()) {
            return false;
        }

        DB::transaction(function () use ($user, $comment) {
            $this->events()->create([
                'type' => BeatmapsetEvent::DISQUALIFY,
                'user_id' => $user->user_id,
                'comment' => $comment,
            ]);

            $this->setApproved('pending', $user);
        });

        return true;
    }

    public function qualify($user)
    {
        if (!$this->isPending()) {
            return false;
        }

        DB::transaction(function () use ($user) {
            $this->events()->create(['type' => BeatmapsetEvent::QUALIFY]);

            $this->setApproved('qualified', $user);
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
                    $this->qualify($user);
                }
            }
        });

        return true;
    }

    public function nominators()
    {
        $events = $this
            ->recentEvents()
            ->with('user')
            ->where(['type' => BeatmapsetEvent::NOMINATE])
            ->select('user_id')
            ->get()
            ->all();

        return array_map(function ($event) {
            if ($event->user !== null) {
                return [
                    'id' => $event->user_id,
                    'username' => $event->user->username,
                ];
            }
        }, $events);
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
        if ($user === null || !$user->hasFavourited($this)) {
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
        return $this->hasMany(BeatmapsetEvent::class, 'beatmapset_id');
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'user_id', 'approvedby_id');
    }

    public function userRatings()
    {
        return $this->hasMany(BeatmapsetUserRating::class, 'beatmapset_id');
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
        return $this->hasMany(FavouriteBeatmapset::class, 'beatmapset_id');
    }

    public function description()
    {
        $topic = Forum\Topic::find($this->thread_id);

        if ($topic === null) {
            return;
        }

        $post = Forum\Post::find($topic->topic_first_post_id);

        // Any description (after the first match) that matches
        // '[-{15}]' within its body doesn't get split anymore,
        // and gets stored in $split[1] anyways
        $split = preg_split('[-{15}]', $post->post_text, 2);

        // Return empty description if the pattern was not found
        // (mostly older beatmapsets)
        $description = $split[1] ?? '';

        return (new \App\Libraries\BBCodeFromDB($description, $post->bbcode_uid, true))->toHTML(true);
    }

    public function toMetaDescription()
    {
        $section = trans('layout.menu.beatmaps._');

        return "osu! » {$section} » {$this->artist} - {$this->title}";
    }
}
