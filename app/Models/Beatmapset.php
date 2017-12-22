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
use App\Libraries\BBCodeFromDB;
use App\Libraries\ImageProcessorService;
use App\Libraries\StorageWithUrl;
use App\Transformers\BeatmapsetTransformer;
use Cache;
use Carbon\Carbon;
use Datadog;
use DB;
use Elasticsearch\Common\Exceptions\BadRequest400Exception as ElasticsearchBadRequest;
use Es;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;

class Beatmapset extends Model
{
    use SoftDeletes;

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
        'discussion_enabled' => 'boolean',
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
    const HYPEABLE_STATES = [-1, 0, 3];

    const NOMINATIONS_PER_DAY = 3;
    const RANKED_PER_DAY = 8;
    const MINIMUM_DAYS_FOR_RANKING = 7;
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

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class, 'beatmapset_id', 'beatmapset_id');
    }

    public function recentFavourites($limit = 50)
    {
        $favourites = FavouriteBeatmapset::where('beatmapset_id', $this->beatmapset_id)
            ->with('user')
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            })
            ->orderBy('dateadded', 'desc')
            ->limit($limit)
            ->get();

        return $favourites->pluck('user');
    }

    public function watches()
    {
        return $this->hasMany(BeatmapsetWatch::class, 'beatmapset_id', 'beatmapset_id');
    }

    public function lastDiscussionTime()
    {
        $time = $this->beatmapDiscussions()->max('updated_at');

        if ($time !== null) {
            return Carbon::parse($time);
        }
    }

    public function scopeRankable($query)
    {
        return $query->qualified()
            ->where('approved_date', '>', DB::raw('date_sub(now(), interval 30 day)'))
            ->get();
    }

    /**
     * Includes if player has completed the set in a given playmode
     * Returns the count of beatmaps in the set that were completed
     * in a specified column, or 'count' by default.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $mode playmode to include.
     * @param mixed $fieldName field name to return the count in.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithHasCompleted($query, $mode, $user, $fieldName = 'count')
    {
        if (Beatmap::modeStr($mode) === null) {
            throw new \Exception('invalid game mode');
        }

        $scoreClass = Score\Best\Model::getClass($mode);
        $beatmapsetTable = $this->getTable();
        $beatmapTable = (new Beatmap)->getTable();
        $scoreBestTable = (new $scoreClass)->getTable();

        if ($user) {
            $userId = $user->user_id;
            $counts = DB::raw("(SELECT count(*)
                                    FROM {$scoreBestTable}
                                    WHERE {$scoreBestTable}.user_id = {$userId}
                                    AND {$scoreBestTable}.beatmap_id IN (SELECT beatmap_id
                                        FROM {$beatmapTable} WHERE {$beatmapTable}.beatmapset_id = {$beatmapsetTable}.beatmapset_id
                                    )
                                ) as {$fieldName}");
        } else {
            $counts = DB::raw("(SELECT 0) as {$fieldName}");
        }

        return $query->addSelect($counts);
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
        return $query->whereIn('approved', [static::STATES['pending'], static::STATES['wip']]);
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
        // simple stuff
        $params['query'] = presence($params['query'] ?? null);
        $params['status'] = get_int($params['status'] ?? null) ?? 0;
        $params['genre'] = get_int($params['genre'] ?? null);
        $params['language'] = get_int($params['language'] ?? null);
        $params['extra'] = explode('.', $params['extra'] ?? null);
        $params['limit'] = clamp(get_int($params['limit'] ?? config('osu.beatmaps.max')), 1, config('osu.beatmaps.max'));
        $params['page'] = max(1, get_int($params['page'] ?? 1));
        $params['offset'] = ($params['page'] - 1) * $params['limit'];

        // mode
        $params['mode'] = get_int($params['mode'] ?? null);
        if (!in_array($params['mode'], Beatmap::MODES, true)) {
            $params['mode'] = null;
        }

        // rank
        $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];
        $params['rank'] = array_intersect(explode('.', $params['rank'] ?? null), $validRanks);

        // sort_order, sort_field (and clear up sort)
        $sort = explode('_', array_pull($params, 'sort'));

        $validSortFields = [
            'artist' => 'artist',
            'creator' => 'creator',
            'difficulty' => 'difficultyrating',
            'plays' => 'playcount',
            'ranked' => 'approved_date',
            'rating' => 'rating',
            'relevance' => '_score',
            'title' => 'title',
            'updated' => 'last_update',
        ];
        $params['sort_field'] = $validSortFields[$sort[0] ?? null] ?? null;

        $params['sort_order'] = $sort[1] ?? null;
        if (!in_array($params['sort_order'], ['asc', 'desc'], true)) {
            $params['sort_order'] = 'desc';
        }

        if ($params['sort_field'] === null) {
            if (present($params['query'])) {
                $params['sort_field'] = '_score';
                $params['sort_order'] = 'desc';
            } else {
                if ($params['status'] === 4 || $params['status'] === 5) {
                    $params['sort_field'] = 'last_update';
                    $params['sort_order'] = 'desc';
                } else {
                    $params['sort_field'] = 'approved_date';
                    $params['sort_order'] = 'desc';
                }
            }
        }

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
            $query = es_query_escape_with_caveats($params['query']);
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
                    ->select('beatmap_id');

                if ($unionQuery === null) {
                    $unionQuery = $newQuery;
                } else {
                    $unionQuery->union($newQuery);
                }
            }

            $beatmapIds = model_pluck($unionQuery, 'beatmap_id');
            $beatmapsetIds = model_pluck(Beatmap::whereIn('beatmap_id', $beatmapIds), 'beatmapset_id');

            $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $beatmapsetIds]];
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
                $favs = model_pluck($params['user']->favouriteBeatmapsets(), 'beatmapset_id', self::class);
                $matchParams[] = ['ids' => ['type' => 'beatmaps', 'values' => $favs]];
                break;
            case 3: // Qualified
                $shouldParams[] = [
                    ['match' => ['approved' => self::STATES['qualified']]],
                ];
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

        try {
            $results = Es::search($searchParams);
        } catch (ElasticsearchBadRequest $e) {
            $results = ['hits' => [
                'hits' => [],
                'total' => 0,
            ]];
        }

        $beatmapsetIds = array_map(
            function ($e) {
                return $e['_id'];
            },
            $results['hits']['hits']
        );

        return [
            'ids' => $beatmapsetIds,
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
        $startTime = microtime(true);
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

        if (config('datadog-helper.enabled')) {
            $searchDuration = microtime(true) - $startTime;
            Datadog::microtiming(config('datadog-helper.prefix').'.search', $searchDuration, 1, ['type' => 'beatmapset']);
        }

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

    public function removeCovers()
    {
        try {
            $this->storage()->deleteDirectory($this->coverPath());
        } catch (\Exception $e) {
            // ignore errors
        }

        $this->update(['cover_updated_at' => $this->freshTimestamp()]);
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

            // start by clearing existing covers
            $this->removeCovers();

            // download and extract beatmap
            $osz = "$tmpBase/osz.zip";
            try {
                $url = BeatmapMirror::getRandom()->generateUrl($this, true);
                $ok = copy($url, $osz);
                if (!$ok) {
                    throw new BeatmapProcessorException('Error retrieving beatmap');
                }
            } catch (\Exception $e) {
                throw new BeatmapProcessorException('Error retrieving beatmap');
            }

            $zip = new \ZipArchive;
            $zip->open($osz);
            $zip->extractTo($workingFolder);
            $zip->close();

            // scan through all the beatmaps in this set and find the first one with a valid background image
            foreach ($this->beatmaps as $beatmap) {
                $bgFilename = self::scanBMForBG("{$workingFolder}/{$beatmap->filename}");

                if ($bgFilename === false) {
                    continue;
                }

                $bgFile = ci_file_search("{$workingFolder}/{$bgFilename}");

                if ($bgFile === false) {
                    continue;
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

                // break after the first image has been successfully processed
                break;
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
        try {
            $content = file_get_contents($beatmapFilename);
            if (!$content) {
                return false;
            }
        } catch (\Exception $e) {
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

            // global event
            Event::generate('beatmapsetApprove', ['beatmapset' => $this]);
        });

        return true;
    }

    public function nominate(User $user)
    {
        if (!$this->isPending()) {
            $message = trans('beatmaps.nominations.incorrect_state');
        }

        // check if there are any outstanding issues still
        if ($this->beatmapDiscussions()->openIssues()->count() > 0) {
            $message = trans('beatmaps.nominations.unresolved_issues');
        }

        if (isset($message)) {
            return [
                'result' => false,
                'message' => $message,
            ];
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

        return [
            'result' => true,
        ];
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

    public function requiredHype()
    {
        return config('osu.beatmapset.required_hype');
    }

    public function canBeHyped()
    {
        return in_array($this->approved, static::HYPEABLE_STATES, true);
    }

    public function validateHypeBy($user)
    {
        if ($user === null) {
            $message = 'guest';
        } else {
            if ($this->user_id === $user->getKey()) {
                $message = 'owner';
            } else {
                $hyped = $this
                    ->beatmapDiscussions()
                    ->withoutDeleted()
                    ->ofType('hype')
                    ->where('user_id', '=', $user->getKey())
                    ->exists();

                if ($hyped) {
                    $message = 'hyped';
                } elseif ($user->remainingHype() <= 0) {
                    $message = 'limit_exceeded';
                }
            }
        }

        if (isset($message)) {
            return [
                'result' => false,
                'message' => trans("model_validation.beatmap_discussion.hype.{$message}"),
            ];
        } else {
            return ['result' => true];
        }
    }

    public function requiredNominationCount()
    {
        return 2;
    }

    public function currentNominationCount()
    {
        return count($this->recentEvents()->nominations()->get());
    }

    public function hasNominations()
    {
        return $this->currentNominationCount() > 0;
    }

    public function rankingETA()
    {
        if (!$this->isQualified()) {
            return;
        }

        $queueSize = static::qualified()->where('approved_date', '<', $this->approved_date)->count();
        $days = ceil($queueSize / static::RANKED_PER_DAY);

        $minDays = static::MINIMUM_DAYS_FOR_RANKING - $this->approved_date->diffInDays();
        $days = max($minDays, $days);

        return $days > 0 ? Carbon::now()->addDays($days) : null;
    }

    public function recentEvents()
    {
        // relevant events differ depending on state of beatmapset
        $events = $this->events();
        switch ($this->approved) {
            case self::STATES['pending']:
            case self::STATES['qualified']:
                // last 'disqualify' or 'nomination reset' event (if any) and all events since
                $resetEvent = $this->events()->disqualificationAndNominationResetEvents()->orderBy('created_at', 'desc')->first();

                if ($resetEvent) {
                    $events->where('id', '>=', $resetEvent->id);
                }
        }

        return $events;
    }

    public function status()
    {
        return array_search_null($this->approved, static::STATES);
    }

    public function defaultJson($currentUser = null)
    {
        $includes = ['beatmaps', 'current_user_attributes', 'nominations'];

        return json_item($this, new BeatmapsetTransformer, $includes);
    }

    public function defaultDiscussionJson()
    {
        return json_item(
            static::with([
                'beatmapDiscussions.beatmapDiscussionPosts',
                'beatmapDiscussions.beatmapDiscussionVotes',
                'beatmapDiscussions.beatmapset',
                'beatmapDiscussions.beatmap',
            ])->find($this->getKey()),
            'BeatmapsetDiscussion',
            [
                'beatmapset',
                'beatmap_discussions.beatmap_discussion_posts',
                'beatmap_discussions.current_user_attributes',
                'beatmapset_events',
                'users',
                'users.groups',
            ]
        );
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
        $bbcode = $this->getBBCode();

        return $bbcode ? $bbcode->toHTML() : null;
    }

    public function editableDescription()
    {
        $bbcode = $this->getBBCode();

        return $bbcode ? $bbcode->toEditor() : null;
    }

    public function updateDescription($bbcode, $user)
    {
        $post = $this->getPost();
        if ($post === null) {
            return;
        }

        $split = preg_split('/-{15}/', $post->post_text, 2);

        $options = [
            'withGallery' => true,
            'ignoreLineHeight' => true,
        ];

        $header = new BBCodeFromDB($split[0], $post->bbcode_uid, $options);
        $newBody = $header->toEditor()."---------------\n".ltrim($bbcode);

        return $post->edit($newBody, $user);
    }

    public function toMetaDescription()
    {
        $section = trans('layout.menu.beatmaps._');

        return "osu! » {$section} » {$this->artist} - {$this->title}";
    }

    private function extractDescription($post)
    {
        // Any description (after the first match) that matches
        // '/-{15}/' within its body doesn't get split anymore,
        // and gets stored in $split[1] anyways
        $split = preg_split('/-{15}/', $post->post_text, 2);

        // Return empty description if the pattern was not found
        // (mostly older beatmapsets)
        return ltrim($split[1] ?? '');
    }

    private function getBBCode()
    {
        $post = $this->getPost();

        if ($post === null) {
            return;
        }

        $description = $this->extractDescription($post);

        $options = [
            'withGallery' => true,
            'ignoreLineHeight' => true,
        ];

        return new BBCodeFromDB($description, $post->bbcode_uid, $options);
    }

    private function getPost()
    {
        $topic = Forum\Topic::find($this->thread_id);

        if ($topic === null) {
            return;
        }

        return Forum\Post::find($topic->topic_first_post_id);
    }
}
