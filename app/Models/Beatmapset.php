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
use App\Jobs\CheckBeatmapsetCovers;
use App\Jobs\EsIndexDocument;
use App\Jobs\RemoveBeatmapsetBestScores;
use App\Libraries\BBCodeFromDB;
use App\Libraries\ImageProcessorService;
use App\Libraries\StorageWithUrl;
use App\Libraries\Transactions\AfterCommit;
use Cache;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;

class Beatmapset extends Model implements AfterCommit
{
    use Elasticsearch\BeatmapsetTrait, SoftDeletes;

    protected $_storage = null;
    protected $table = 'osu_beatmapsets';
    protected $primaryKey = 'beatmapset_id';

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
        'cover_updated_at',
        'deleted_at',
        'last_update',
        'queued_at',
        'submit_date',
        'thread_icon_date',
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

    const RANKED_PER_DAY = 8;
    const MINIMUM_DAYS_FOR_RANKING = 7;
    const BUNDLED_IDS = [3756, 163112, 140662, 151878, 190390, 123593, 241526, 299224];

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

    public function scopeLoved($query)
    {
        return $query->where('approved', '=', self::STATES['loved']);
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
        return $query->whereIn(
            'approved',
            [self::STATES['ranked'], self::STATES['approved'], self::STATES['qualified']]
        );
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

    public function isLoved()
    {
        return $this->approved === self::STATES['loved'];
    }

    public function isLoveable()
    {
        return $this->approved <= 0;
    }

    public function isScoreable()
    {
        return $this->approved > 0;
    }

    // TODO: remove this and update the coffee side names to match isScoreable.
    public function hasScores()
    {
        return $this->attributes['approved'] > 0;
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

    public static function coverSizes()
    {
        $shapes = ['cover', 'card', 'list', 'slimcover'];
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

    public function coverURL($coverSize = 'cover', $customTimestamp = null)
    {
        if (!self::isValidCoverSize($coverSize)) {
            return false;
        }

        $timestamp = 0;
        if ($customTimestamp) {
            $timestamp = $customTimestamp;
        } elseif ($this->cover_updated_at) {
            $timestamp = $this->cover_updated_at->format('U');
        }

        return $this->storage()->url($this->coverPath()."{$coverSize}.jpg?{$timestamp}");
    }

    public function coverPath()
    {
        return "beatmaps/{$this->beatmapset_id}/covers/";
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

    public function fetchBeatmapsetArchive()
    {
        $oszFile = tmpfile();
        $mirrorsToUse = config('osu.beatmap_processor.mirrors_to_use');
        $url = BeatmapMirror::getRandomFromList($mirrorsToUse)->generateURL($this, true);

        if ($url === false) {
            return false;
        }

        $bytesWritten = fwrite($oszFile, file_get_contents($url));

        if ($bytesWritten === false) {
            throw new BeatmapProcessorException('Error retrieving beatmap');
        }

        return new BeatmapsetArchive(get_stream_filename($oszFile));
    }

    public function regenerateCovers(array $sizesToRegenerate = null)
    {
        if (empty($sizesToRegenerate)) {
            $sizesToRegenerate = static::coverSizes();
        }

        $osz = $this->fetchBeatmapsetArchive();
        if ($osz === false) {
            return false;
        }

        // clear existing covers
        $this->removeCovers();

        $beatmapFilenames = $this->beatmaps->map(function ($beatmap) {
            return $beatmap->filename;
        });

        // scan for background images in $beatmapFilenames, with fallback enabled
        $backgroundFilename = $osz->scanBeatmapsForBackground($beatmapFilenames->toArray(), true);

        if ($backgroundFilename !== false) {
            $tmpFile = tmpfile();
            $bytesWritten = fwrite($tmpFile, $osz->readFile($backgroundFilename));
            fseek($tmpFile, 0); // reset file position cursor, required for storeCover below
            $backgroundImage = get_stream_filename($tmpFile);

            // upload original image
            $this->storeCover('raw.jpg', $backgroundImage);
            $timestamp = time();

            $processor = new ImageProcessorService();

            // upload optimized full-size version
            $optimized = $processor->optimize($this->coverURL('raw', $timestamp));
            $this->storeCover('fullsize.jpg', get_stream_filename($optimized));

            // use thumbnailer to generate (and then upload) all our variants
            foreach ($sizesToRegenerate as $size) {
                $resized = $processor->resize($this->coverURL('fullsize', $timestamp), $size);
                $this->storeCover("$size.jpg", get_stream_filename($resized));
            }
        }

        $this->update(['cover_updated_at' => $this->freshTimestamp()]);
    }

    public function allCoverImagesPresent()
    {
        foreach ($this->allCoverURLs() as $_size => $url) {
            if (!check_url($url)) {
                return false;
            }
        }

        return true;
    }

    public function setApproved($state, $user)
    {
        $currentTime = Carbon::now();

        if ($this->isQualified() && $state === 'pending') {
            $this->previous_queue_duration = ($this->queued_at ?? $this->approved_date)->diffinSeconds();
            $this->queued_at = null;
        } elseif ($this->isPending() && $state === 'qualified') {
            $maxAdjustment = (static::MINIMUM_DAYS_FOR_RANKING - 1) * 24 * 3600;
            $adjustment = min($this->previous_queue_duration, $maxAdjustment);
            $this->queued_at = $currentTime->copy()->subSeconds($adjustment);
        }

        $this->approved = static::STATES[$state];

        if ($this->approved > 0) {
            $this->approved_date = $currentTime;
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

    public function qualify($user)
    {
        if (!$this->isPending()) {
            return false;
        }

        DB::transaction(function () use ($user) {
            $this->events()->create(['type' => BeatmapsetEvent::QUALIFY]);

            $this->setApproved('qualified', $user);
            $this->userRatings()->delete();

            // global event
            Event::generate('beatmapsetApprove', ['beatmapset' => $this]);

            // enqueue a cover check job to ensure cover images are all present
            $job = (new CheckBeatmapsetCovers($this))->onQueue('beatmap_high');
            dispatch($job);

            // remove current scores
            dispatch(new RemoveBeatmapsetBestScores($this));
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
            $nomination = $this->nominationsSinceReset()->where('user_id', $user->user_id);
            if (!$nomination->exists()) {
                $this->events()->create(['type' => BeatmapsetEvent::NOMINATE, 'user_id' => $user->user_id]);
                if ($this->currentNominationCount() >= $this->requiredNominationCount()) {
                    $this->qualify($user);
                }
            }
            $this->refreshCache();
        });

        return [
            'result' => true,
        ];
    }

    public function love(User $user)
    {
        if (!$this->isLoveable()) {
            return [
                'result' => false,
                'message' => trans('beatmaps.nominations.incorrect_state'),
            ];
        }

        $this->getConnection()->transaction(function () use ($user) {
            $this->events()->create(['type' => BeatmapsetEvent::LOVE, 'user_id' => $user->user_id]);
            $this->setApproved('loved', $user);
            $this->userRatings()->delete();

            Event::generate('beatmapsetApprove', ['beatmapset' => $this]);

            dispatch((new CheckBeatmapsetCovers($this))->onQueue('beatmap_high'));
            dispatch(new RemoveBeatmapsetBestScores($this));
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

            $this->favourite_count = db_unsigned_increment('favourite_count', -1);
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

    public function allBeatmaps()
    {
        return $this->hasMany(Beatmap::class, 'beatmapset_id')->withTrashed();
    }

    public function events()
    {
        return $this->hasMany(BeatmapsetEvent::class, 'beatmapset_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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
                    ->withoutTrashed()
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
                'message' => trans("model_validation.beatmapset_discussion.hype.{$message}"),
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
        return $this->nominationsSinceReset()->count();
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

        $modes = $this->beatmaps->pluck('playmode')->unique()->toArray();

        $queueSize = static::qualified()
            ->whereHas('beatmaps', function ($query) use ($modes) {
                $query->whereIn('playmode', $modes);
            })
            ->whereDoesntHave('beatmaps', function ($query) use ($modes) {
                $query->where('playmode', '<', min($modes));
            })
            ->where('queued_at', '<', $this->queued_at)
            ->count();
        $days = ceil($queueSize / static::RANKED_PER_DAY);

        $minDays = static::MINIMUM_DAYS_FOR_RANKING - $this->queued_at->diffInDays();
        $days = max($minDays, $days);

        return $days > 0 ? Carbon::now()->addDays($days) : null;
    }

    public function disqualificationEvent()
    {
        return $this->events()->disqualifications()->orderBy('created_at', 'desc')->first();
    }

    public function resetEvent()
    {
        return $this->events()->disqualificationAndNominationResetEvents()->orderBy('created_at', 'desc')->first();
    }

    public function eventsSinceReset()
    {
        $events = $this->events();

        $resetEvent = $this->resetEvent();
        if ($resetEvent) {
            $events->where('id', '>=', $resetEvent->id);
        }

        return $events;
    }

    public function nominationsSinceReset()
    {
        return $this->eventsSinceReset()->nominations();
    }

    public function status()
    {
        return array_search_null($this->approved, static::STATES);
    }

    public function defaultJson()
    {
        return json_item($this, 'Beatmapset', [
            'beatmaps',
            'current_user_attributes',
            'nominations',
        ]);
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
            'Beatmapset',
            [
                'beatmaps:with_trashed',
                'current_user_attributes',
                'discussions',
                'discussions.current_user_attributes',
                'discussions.posts',
                'events',
                'nominations',
                'related_users',
                'related_users.groups',
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

        return $post
            ->skipBeatmapPostRestrictions()
            ->update([
                'post_text' => $newBody,
                'post_edit_user' => $user === null ? null : $user->getKey(),
            ]);
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

    public function getPost()
    {
        $topic = Forum\Topic::find($this->thread_id);

        if ($topic === null) {
            return;
        }

        return Forum\Post::find($topic->topic_first_post_id);
    }

    public function freshHype()
    {
        return $this
            ->beatmapDiscussions()
            ->withoutTrashed()
            ->ofType('hype')
            ->count();
    }

    public function refreshCache()
    {
        return $this->update([
            'hype' => $this->freshHype(),
            'nominations' => $this->currentNominationCount(),
        ]);
    }

    public function afterCommit()
    {
        dispatch(new EsIndexDocument($this));
    }

    public static function removeMetadataText($text)
    {
        // TODO: see if can be combined with description extraction thingy without
        // exploding
        static $pattern = '/^(.*?)-{15}/s';

        return preg_replace($pattern, '', $text);
    }
}
