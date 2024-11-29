<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Enums\Ruleset;
use App\Exceptions\BeatmapProcessorException;
use App\Exceptions\ImageProcessorServiceException;
use App\Exceptions\InvariantException;
use App\Jobs\CheckBeatmapsetCovers;
use App\Jobs\EsDocument;
use App\Jobs\Notifications\BeatmapsetDiscussionLock;
use App\Jobs\Notifications\BeatmapsetDiscussionUnlock;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetLove;
use App\Jobs\Notifications\BeatmapsetQualify;
use App\Jobs\Notifications\BeatmapsetRank;
use App\Jobs\Notifications\BeatmapsetRemoveFromLoved;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Jobs\RemoveBeatmapsetBestScores;
use App\Jobs\RemoveBeatmapsetSoloScores;
use App\Libraries\BBCodeFromDB;
use App\Libraries\Beatmapset\BeatmapsetMainRuleset;
use App\Libraries\Beatmapset\NominateBeatmapset;
use App\Libraries\Commentable;
use App\Libraries\Elasticsearch\Indexable;
use App\Libraries\ImageProcessorService;
use App\Libraries\StorageUrl;
use App\Libraries\Transactions\AfterCommit;
use App\Traits\Memoizes;
use App\Traits\Validatable;
use App\Transformers\BeatmapsetTransformer;
use Cache;
use Carbon\Carbon;
use DB;
use Ds\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Request;

/**
 * @property bool $active
 * @property \Illuminate\Database\Eloquent\Collection $allBeatmaps Beatmap
 * @property int $approved
 * @property \Carbon\Carbon|null $approved_date
 * @property int|null $approvedby_id
 * @property User|null $approver
 * @property string $artist
 * @property string $artist_unicode
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussions BeatmapDiscussion
 * @property \Illuminate\Database\Eloquent\Collection $beatmaps Beatmap
 * @property int $beatmapset_id
 * @property \Illuminate\Database\Eloquent\Collection $beatmapsetNominations BeatmapsetNomination
 * @property mixed|null $body_hash
 * @property float $bpm
 * @property bool $comment_locked
 * @property string $commentable_identifier
 * @property Comment $comments
 * @property \Carbon\Carbon|null $cover_updated_at
 * @property string $creator
 * @property \Illuminate\Database\Eloquent\Collection $defaultBeatmaps Beatmap
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $difficulty_names
 * @property bool $discussion_locked
 * @property string $displaytitle
 * @property bool $download_disabled
 * @property string|null $download_disabled_url
 * @property string[]|null $eligible_main_rulesets
 * @property bool $epilepsy
 * @property \Illuminate\Database\Eloquent\Collection $events BeatmapsetEvent
 * @property int $favourite_count
 * @property \Illuminate\Database\Eloquent\Collection $favourites FavouriteBeatmapset
 * @property string|null $filename
 * @property int $filesize
 * @property int|null $filesize_novideo
 * @property Genre $genre
 * @property int $genre_id
 * @property mixed|null $header_hash
 * @property int $hype
 * @property Language $language
 * @property int $language_id
 * @property \Carbon\Carbon $last_update
 * @property int $nominations
 * @property bool $nsfw
 * @property int $offset
 * @property mixed|null $osz2_hash
 * @property int $play_count
 * @property int $previous_queue_duration
 * @property \Carbon\Carbon|null $queued_at
 * @property float $rating
 * @property string $source
 * @property bool $spotlight
 * @property int $star_priority
 * @property bool $storyboard
 * @property \Carbon\Carbon|null $submit_date
 * @property string $tags
 * @property \Carbon\Carbon|null $thread_icon_date
 * @property int $thread_id
 * @property string $title
 * @property string $title_unicode
 * @property ArtistTrack $track
 * @property int|null $track_id
 * @property User $user
 * @property \Illuminate\Database\Eloquent\Collection $userRatings BeatmapsetUserRating
 * @property int $user_id
 * @property int $versions_available
 * @property bool $video
 * @property \Illuminate\Database\Eloquent\Collection $watches BeatmapsetWatch
 */
class Beatmapset extends Model implements AfterCommit, Commentable, Indexable, Traits\ReportableInterface
{
    use Memoizes, SoftDeletes, Traits\CommentableDefaults, Traits\Es\BeatmapsetSearch, Traits\Reportable, Validatable;

    const CASTS = [
        'active' => 'boolean',
        'approved_date' => 'datetime',
        'comment_locked' => 'boolean',
        'cover_updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'discussion_locked' => 'boolean',
        'download_disabled' => 'boolean',
        'eligible_main_rulesets' => 'array',
        'epilepsy' => 'boolean',
        'last_update' => 'datetime',
        'nsfw' => 'boolean',
        'queued_at' => 'datetime',
        'spotlight' => 'boolean',
        'storyboard' => 'boolean',
        'submit_date' => 'datetime',
        'thread_icon_date' => 'datetime',
        'video' => 'boolean',
    ];

    const HYPEABLE_STATES = [-1, 0, 3];

    const MAX_FIELD_LENGTHS = [
        'tags' => 1000,
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

    public $timestamps = false;

    protected $attributes = [
        'hype' => 0,
        'nominations' => 0,
        'previous_queue_duration' => 0,
    ];

    protected $casts = self::CASTS;
    protected $primaryKey = 'beatmapset_id';
    protected $table = 'osu_beatmapsets';

    public static function coverSizes()
    {
        static $sizes;

        if ($sizes === null) {
            $sizes = [];
            foreach (['cover', 'card', 'list', 'slimcover'] as $shape) {
                foreach (['', '@2x'] as $scale) {
                    $sizes[] = "{$shape}{$scale}";
                }
            }
        }

        return $sizes;
    }

    public static function popular()
    {
        $ids = cache_remember_mutexed('popularBeatmapsetIds', 300, [], function () {
            return static::popularIds();
        });

        return static::whereIn('beatmapset_id', $ids)->orderByField('beatmapset_id', $ids);
    }

    public static function popularIds()
    {
        $recentIds = static::ranked()
            ->where('approved_date', '>', now()->subDays(30))
            ->where('nsfw', false)
            ->select('beatmapset_id');

        return FavouriteBeatmapset::select('beatmapset_id')
            ->selectRaw('COUNT(*) as cnt')
            ->whereIn('beatmapset_id', $recentIds)
            ->where('dateadded', '>', now()->subDays(7))->groupBy('beatmapset_id')
            ->orderBy('cnt', 'DESC')
            ->limit(5)
            ->pluck('beatmapset_id')
            ->toArray();
    }

    public static function latestRanked($count = 5)
    {
        // TODO: add filtering by game mode after mode-toggle UI/UX happens

        return Cache::remember("beatmapsets_latest_{$count}", 3600, function () use ($count) {
            // We union here so mysql can use indexes to speed this up
            $ranked = self::ranked()->active()->where('nsfw', false)->orderBy('approved_date', 'desc')->limit($count);
            $approved = self::approved()->active()->where('nsfw', false)->orderBy('approved_date', 'desc')->limit($count);

            return $ranked->union($approved)->orderBy('approved_date', 'desc')->limit($count)->get();
        });
    }

    public static function removeMetadataText($text)
    {
        // TODO: see if can be combined with description extraction thingy without
        // exploding
        static $pattern = '/^(.*?)-{15}/s';

        return preg_replace($pattern, '', $text);
    }

    public static function isValidBackgroundImage(string $path): bool
    {
        $dimensions = read_image_properties($path);

        static $validTypes = [
            IMAGETYPE_GIF,
            IMAGETYPE_JPEG,
            IMAGETYPE_PNG,
        ];

        return isset($dimensions[2]) && in_array($dimensions[2], $validTypes, true);
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
    }

    public function bssProcessQueues()
    {
        return $this->hasMany(BssProcessQueue::class);
    }

    public function packs(): BelongsToMany
    {
        return $this->belongsToMany(BeatmapPack::class, BeatmapPackItem::class);
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
        return $this->hasMany(BeatmapsetWatch::class);
    }

    public function lastDiscussionTime()
    {
        $lastDiscussionUpdate = $this->beatmapDiscussions()->max('updated_at');
        $lastEventUpdate = $this->events()->max('updated_at');

        $lastDiscussionDate = $lastDiscussionUpdate !== null ? Carbon::parse($lastDiscussionUpdate) : null;
        $lastEventDate = $lastEventUpdate !== null ? Carbon::parse($lastEventUpdate) : null;

        return max($lastDiscussionDate, $lastEventDate);
    }

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

    public function scopeDisqualified($query)
    {
        // uses the fact that disqualifying sets previous_queue_duration which is otherwise 0.
        return $query
            ->where('approved', self::STATES['pending'])
            ->where('previous_queue_duration', '>', 0);
    }

    public function scopeNeverQualified($query)
    {
        return $query->withStates(['pending', 'wip'])->where('previous_queue_duration', 0);
    }

    public function scopeWithPackTags(Builder $query): Builder
    {
        $idColumn = $this->qualifyColumn('beatmapset_id');
        $packTagColumn = (new BeatmapPack())->qualifyColumn('tag');
        $packItemBeatmapsetIdColumn = (new BeatmapPackItem())->qualifyColumn('beatmapset_id');
        $packQuery = BeatmapPack
            ::selectRaw("GROUP_CONCAT({$packTagColumn} SEPARATOR ',')")
            ->default()
            ->whereRelation(
                'items',
                DB::raw($packItemBeatmapsetIdColumn),
                DB::raw($idColumn),
            )->toRawSql();

        return $query
            ->select('*')
            ->selectRaw("({$packQuery}) as pack_tags");
    }

    public function scopeWithStates($query, $states)
    {
        return $query->whereIn('approved', array_map(fn ($s) => static::STATES[$s], $states));
    }

    public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    public function scopeHasMode($query, $modeInts)
    {
        if (!is_array($modeInts)) {
            $modeInts = [$modeInts];
        }

        return $query->whereHas('beatmaps', function ($query) use ($modeInts) {
            $query->whereIn('playmode', $modeInts);
        });
    }

    public function scopeScoreable(Builder $query): void
    {
        $query->where('approved', '>', 0);
    }

    public function scopeToBeRanked(Builder $query, Ruleset $ruleset)
    {
        return $query->qualified()
            ->withoutTrashed()
            ->withModesForRanking($ruleset->value)
            ->where('queued_at', '<', now()->subDays($GLOBALS['cfg']['osu']['beatmapset']['minimum_days_for_rank']))
            ->whereDoesntHave('beatmapDiscussions', fn ($q) => $q->openIssues());
    }

    public function scopeWithModesForRanking($query, $modeInts)
    {
        if (!is_array($modeInts)) {
            $modeInts = [$modeInts];
        }

        $query->whereHas('beatmaps', function ($query) use ($modeInts) {
            $query->whereIn('playmode', $modeInts);
        })->whereDoesntHave('beatmaps', function ($query) use ($modeInts) {
            $query->where('playmode', '<', min($modeInts));
        });
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

    public function allCoverURLs()
    {
        $urls = [];
        $timestamp = $this->defaultCoverTimestamp();
        foreach (self::coverSizes() as $size) {
            $urls[$size] = $this->coverURL($size, $timestamp);
        }

        return $urls;
    }

    public function coverURL($coverSize = 'cover', $customTimestamp = null)
    {
        $timestamp = $customTimestamp ?? $this->defaultCoverTimestamp();

        return StorageUrl::make(null, $this->coverPath()."{$coverSize}.jpg?{$timestamp}");
    }

    public function coverPath()
    {
        $id = $this->getKey() ?? 0;

        return "beatmaps/{$id}/covers/";
    }

    public function storeCover($target_filename, $source_path)
    {
        \Storage::put($this->coverPath().$target_filename, file_get_contents($source_path));
    }

    public function downloadLimited()
    {
        return $this->download_disabled || $this->download_disabled_url !== null;
    }

    public function previewURL()
    {
        return '//b.ppy.sh/preview/'.$this->beatmapset_id.'.mp3';
    }

    public function removeCovers()
    {
        try {
            \Storage::deleteDirectory($this->coverPath());
        } catch (\Exception $e) {
            // ignore errors
        }

        $this->update(['cover_updated_at' => $this->freshTimestamp()]);
    }

    public function fetchBeatmapsetArchive()
    {
        $oszFile = tmpfile();
        $mirror = BeatmapMirror::getRandomFromList($GLOBALS['cfg']['osu']['beatmap_processor']['mirrors_to_use'])
            ?? throw new \Exception('no available mirror');
        $url = $mirror->generateURL($this, true);

        if ($url === false) {
            return false;
        }

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_FILE => $oszFile,
            CURLOPT_TIMEOUT => 30,
        ]);
        curl_exec($curl);

        if (curl_errno($curl) > 0) {
            throw new BeatmapProcessorException('Failed downloading osz: '.curl_error($curl));
        }

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // archive file is gone, nothing to do for now
        if ($statusCode === 302) {
            return false;
        }
        if ($statusCode !== 200) {
            throw new BeatmapProcessorException('Failed downloading osz: HTTP Error '.$statusCode);
        }

        try {
            return new BeatmapsetArchive(get_stream_filename($oszFile));
        } catch (BeatmapProcessorException $e) {
            // zip file is broken, nothing to do for now
            return false;
        }
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
            fwrite($tmpFile, $osz->readFile($backgroundFilename));
            $backgroundImage = get_stream_filename($tmpFile);
            if (!static::isValidBackgroundImage($backgroundImage)) {
                return false;
            }

            // upload original image
            $this->storeCover('raw.jpg', $backgroundImage);
            $timestamp = time();

            $processor = new ImageProcessorService();

            // upload optimized full-size version
            try {
                $optimized = $processor->optimize($this->coverURL('raw', $timestamp));
            } catch (ImageProcessorServiceException $e) {
                if ($e->getCode() === ImageProcessorServiceException::INVALID_IMAGE) {
                    return false;
                }
                throw $e;
            }
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

    public function setApproved($state, $user, ?array $beatmapIds = null)
    {
        $currentTime = Carbon::now();
        $oldScoreable = $this->isScoreable();
        $approvedState = static::STATES[$state];
        $beatmaps = $this->beatmaps();

        if ($beatmapIds !== null) {
            $beatmaps->whereKey($beatmapIds);

            if ($beatmaps->count() !== count($beatmapIds)) {
                throw new InvariantException('Invalid beatmap IDs');
            }

            // If the beatmapset will be scoreable, set all of the unspecified
            // beatmaps currently "WIP" or "pending" to "graveyard". It doesn't
            // make sense for any beatmaps to be in those states when they
            // cannot be updated.
            if ($approvedState > 0) {
                $this
                    ->beatmaps()
                    ->whereKeyNot($beatmapIds)
                    ->whereIn('approved', [static::STATES['wip'], static::STATES['pending']])
                    ->update(['approved' => static::STATES['graveyard']]);
            }
        }

        $beatmaps->update(['approved' => $approvedState]);

        if ($this->isQualified() && $state === 'pending') {
            $this->previous_queue_duration = ($this->queued_at ?? $this->approved_date)->diffinSeconds();
            $this->queued_at = null;
        } elseif ($this->isPending() && $state === 'qualified') {
            // Check if any beatmaps where added after most recent invalidated nomination.
            $disqualifyEvent = $this->disqualificationEvent();
            if (
                $disqualifyEvent !== null
                && !(
                    (new Set($this->beatmaps()->pluck('beatmap_id')))
                        ->diff(new Set($disqualifyEvent->comment['beatmap_ids'] ?? []))
                        ->isEmpty())
            ) {
                $this->queued_at = $currentTime;
            } else {
                // amount of queue time to skip.
                $maxAdjustment = ($GLOBALS['cfg']['osu']['beatmapset']['minimum_days_for_rank'] - 1) * 24 * 3600;
                $adjustment = min($this->previous_queue_duration, $maxAdjustment);
                $this->queued_at = $currentTime->copy()->subSeconds($adjustment);

                // additional penalty for disqualification period, 1 day per week disqualified.
                if ($disqualifyEvent !== null) {
                    $interval = $currentTime->diffInDays($disqualifyEvent->created_at);
                    $penaltyDays = min($interval / 7, $GLOBALS['cfg']['osu']['beatmapset']['maximum_disqualified_rank_penalty_days']);
                    $this->queued_at = $this->queued_at->addDays($penaltyDays);
                }
            }
        }

        $this->approved = $approvedState;

        if ($this->approved > 0) {
            $this->approved_date = $currentTime;
            if ($user !== null) {
                $this->approvedby_id = $user->user_id;
            }
        } else {
            $this->approved_date = null;
            $this->approvedby_id = null;
        }

        $this->save();

        if ($this->isScoreable() !== $oldScoreable || $this->isRanked()) {
            dispatch(new RemoveBeatmapsetBestScores($this));
            dispatch(new RemoveBeatmapsetSoloScores($this));
        }

        if ($this->isScoreable() !== $oldScoreable) {
            $this->userRatings()->delete();
        }
    }

    public function discussionLock($user, $reason)
    {
        if ($this->discussion_locked) {
            return;
        }

        DB::transaction(function () use ($user, $reason) {
            BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_LOCK, $user, $this, [
                'reason' => $reason,
            ])->saveOrExplode();
            $this->update(['discussion_locked' => true]);
            (new BeatmapsetDiscussionLock($this, $user))->dispatch();
        });
    }

    public function discussionUnlock($user)
    {
        if (!$this->discussion_locked) {
            return;
        }

        DB::transaction(function () use ($user) {
            BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_UNLOCK, $user, $this)->saveOrExplode();
            $this->update(['discussion_locked' => false]);
            (new BeatmapsetDiscussionUnlock($this, $user))->dispatch();
        });
    }

    public function disqualifyOrResetNominations(User $user, BeatmapDiscussion $discussion)
    {
        $event = BeatmapsetEvent::DISQUALIFY;
        $notificationClass = BeatmapsetDisqualify::class;
        if ($this->isPending()) {
            $event = BeatmapsetEvent::NOMINATION_RESET;
            $notificationClass = BeatmapsetResetNominations::class;
        } else if (!$this->isQualified()) {
            throw new InvariantException('invalid state');
        }

        $this->getConnection()->transaction(function () use ($discussion, $event, $notificationClass, $user) {
            $nominators = User::whereIn('user_id', $this->beatmapsetNominations()->current()->select('user_id'))->get();
            $extraData = ['nominator_ids' => $nominators->pluck('user_id')];
            if ($event === BeatmapsetEvent::DISQUALIFY) {
                $extraData['beatmap_ids'] = $this->beatmaps()->pluck('beatmap_id');
            }

            BeatmapsetEvent::log($event, $user, $discussion, $extraData)->saveOrExplode();
            foreach ($nominators as $nominator) {
                BeatmapsetEvent::log(
                    BeatmapsetEvent::NOMINATION_RESET_RECEIVED,
                    $nominator,
                    $discussion,
                    ['source_user_id' => $user->getKey(), 'source_user_username' => $user->username]
                )->saveOrExplode();
            }

            $this->beatmapsetNominations()->current()->update(['reset' => true, 'reset_at' => now(), 'reset_user_id' => $user->getKey()]);

            if ($event === BeatmapsetEvent::DISQUALIFY) {
                $this->setApproved('pending', $user);
            }

            $this->refreshCache(true);

            (new $notificationClass($this, $user))->dispatch();
        });
    }

    public function qualify(User $user)
    {
        if (!$this->isPending()) {
            throw new InvariantException('cannot qualify a beatmapset not in a pending state.');
        }

        $this->getConnection()->transaction(function () use ($user) {
            // Reset the queue timer if the beatmapset was previously disqualified,
            // and any of the current nominators were not part of the most recent disqualified nominations.
            $disqualifyEvent = $this->events()->disqualifications()->last();
            if ($disqualifyEvent !== null) {
                $previousNominators = new Set($disqualifyEvent->comment['nominator_ids']);
                $currentNominators = new Set($this->beatmapsetNominations()->current()->pluck('user_id'));
                // Uses xor to make problems during testing stand out, like the number of nominations in the test being wrong.
                if (!$currentNominators->xor($previousNominators)->isEmpty()) {
                    $this->update(['previous_queue_duration' => 0]);
                }
            }

            $this->events()->create(['type' => BeatmapsetEvent::QUALIFY]);

            $this->setApproved('qualified', $user);
            $this->bssProcessQueues()->create();

            // global event
            Event::generate('beatmapsetApprove', ['beatmapset' => $this]);

            // enqueue a cover check job to ensure cover images are all present
            $job = (new CheckBeatmapsetCovers($this))->onQueue('beatmap_high');
            dispatch($job);

            (new BeatmapsetQualify($this, $user))->dispatch();
        });
    }

    public function nominate(User $user, array $playmodes = [])
    {
        (new NominateBeatmapset($this, $user, $playmodes))->handle();
    }

    public function love(User $user, ?array $beatmapIds = null)
    {
        if (!$this->isLoveable()) {
            return [
                'result' => false,
                'message' => osu_trans('beatmaps.nominations.incorrect_state'),
            ];
        }

        $this->getConnection()->transaction(function () use ($user, $beatmapIds) {
            $this->events()->create(['type' => BeatmapsetEvent::LOVE, 'user_id' => $user->user_id]);

            $this->setApproved('loved', $user, $beatmapIds);
            $this->bssProcessQueues()->create();

            Event::generate('beatmapsetApprove', ['beatmapset' => $this]);

            dispatch((new CheckBeatmapsetCovers($this))->onQueue('beatmap_high'));

            (new BeatmapsetLove($this, $user))->dispatch();
        });

        return [
            'result' => true,
        ];
    }

    public function removeFromLoved(User $user, string $reason)
    {
        if (!$this->isLoved()) {
            return [
                'result' => false,
                'message' => osu_trans('beatmaps.nominations.incorrect_state'),
            ];
        }

        $this->getConnection()->transaction(function () use ($user, $reason) {
            BeatmapsetEvent::log(BeatmapsetEvent::REMOVE_FROM_LOVED, $user, $this, compact('reason'))->saveOrExplode();

            $this->setApproved('pending', $user);

            (new BeatmapsetRemoveFromLoved($this, $user))->dispatch();
        });

        return [
            'result' => true,
        ];
    }

    public function rank()
    {
        if (
            !$this->isQualified()
            || $this->beatmapDiscussions()->openIssues()->exists()
        ) {
            return false;
        }

        DB::transaction(function () {
            $this->events()->create(['type' => BeatmapsetEvent::RANK]);

            $this->update(['play_count' => 0]);
            $this->beatmaps()->update(['playcount' => 0, 'passcount' => 0]);
            $this->setApproved('ranked', null);
            $this->bssProcessQueues()->create();

            // global event
            Event::generate('beatmapsetApprove', ['beatmapset' => $this]);

            // enqueue a cover check job to ensure cover images are all present
            $job = (new CheckBeatmapsetCovers($this))->onQueue('beatmap_high');
            dispatch($job);

            (new BeatmapsetRank($this))->dispatch();
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
        if ($user === null || !$user->hasFavourited($this)) {
            return;
        }

        DB::transaction(function () use ($user) {
            $deleted = $this->favourites()->where('user_id', $user->user_id)
                ->delete();

            $this->favourite_count = db_unsigned_increment('favourite_count', -$deleted);
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

    public function allBeatmaps()
    {
        return $this->hasMany(Beatmap::class)->withTrashed();
    }

    public function beatmaps()
    {
        return $this->hasMany(Beatmap::class);
    }

    public function beatmapsetNominations()
    {
        return $this->hasMany(BeatmapsetNomination::class);
    }

    public function beatmapsetNominationsCurrent()
    {
        return $this->beatmapsetNominations()->current();
    }

    public function events()
    {
        return $this->hasMany(BeatmapsetEvent::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'approved',
            'approvedby_id',
            'artist',
            'beatmapset_id',
            'body_hash',
            'bpm',
            'creator',
            'difficulty_names',
            'discussion_enabled',
            'displaytitle',
            'download_disabled_url',
            'favourite_count',
            'filename',
            'filesize',
            'filesize_novideo',
            'genre_id',
            'header_hash',
            'hype',
            'language_id',
            'laravel_through_key', // added by hasOneThrough relation in BeatmapDiscussionPost
            'nominations',
            'offset',
            'osz2_hash',
            'play_count',
            'previous_queue_duration',
            'rating',
            'source',
            'star_priority',
            'storyboard_hash',
            'tags',
            'thread_id',
            'title',
            'track_id',
            'user_id',
            'versions_available' => $this->getRawAttribute($key),

            'eligible_main_rulesets' => $this->getArray($key),

            'approved_date',
            'cover_updated_at',
            'deleted_at',
            'last_update',
            'queued_at',
            'submit_date',
            'thread_icon_date' => $this->getTimeFast($key),

            'approved_date_json',
            'cover_updated_at_json',
            'deleted_at_json',
            'last_update_json',
            'queued_at_json',
            'submit_date_json',
            'thread_icon_date_json' => $this->getJsonTimeFast($key),

            'active',
            'comment_locked',
            'discussion_locked',
            'download_disabled',
            'epilepsy',
            'nsfw',
            'spotlight',
            'storyboard',
            'video' => (bool) $this->getRawAttribute($key),

            'artist_unicode' => $this->getArtistUnicode(),
            'commentable_identifier' => $this->getCommentableIdentifierAttribute(),
            'pack_tags' => $this->getPackTags(),
            'title_unicode' => $this->getTitleUnicode(),

            'allBeatmaps',
            'approver',
            'beatmapDiscussions',
            'beatmaps',
            'beatmapsetNominations',
            'beatmapsetNominationsCurrent',
            'bssProcessQueues',
            'comments',
            'defaultBeatmaps',
            'descriptionPost',
            'events',
            'favourites',
            'genre',
            'language',
            'packs',
            'reportedIn',
            'topic',
            'track',
            'user',
            'userRatings',
            'watches' => $this->getRelationValue($key),
        };
    }

    public function requiredHype()
    {
        return $GLOBALS['cfg']['osu']['beatmapset']['required_hype'];
    }

    public function commentLocked(): bool
    {
        return $this->comment_locked || $this->downloadLimited();
    }

    public function commentableTitle()
    {
        return $this->title;
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
                if ($this->discussion_locked) {
                    $message = 'discussion_locked';
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
        }

        if (isset($message)) {
            return [
                'result' => false,
                'message' => osu_trans("model_validation.beatmapset_discussion.hype.{$message}"),
            ];
        } else {
            return ['result' => true];
        }
    }

    public function currentNominationCount()
    {
        if ($this->isLegacyNominationMode()) {
            return $this->beatmapsetNominations()->current()->count();
        }

        $currentNominations = array_fill_keys($this->playmodesStr(), 0);

        $nominations = $this->beatmapsetNominations()->current()->get();
        foreach ($nominations as $nomination) {
            foreach ($nomination->modes as $mode) {
                if (!isset($currentNominations[$mode])) {
                    continue;
                }

                $currentNominations[$mode]++;
            }
        }

        return $currentNominations;
    }

    public function isLegacyNominationMode()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->beatmapsetNominations()->current()->whereNull('modes')->exists();
        });
    }

    public function hasNominations()
    {
        return $this->beatmapsetNominations()->current()->exists();
    }

    /**
     * This will cause additional query if `difficulty_names` column is blank and beatmaps relation isn't preloaded.
     */
    public function playmodes()
    {
        $rawPlaymodes = present($this->difficulty_names)
            ? collect(explode(',', $this->difficulty_names))
                ->map(fn (string $name) => (int) substr($name, strrpos($name, '@') + 1))
            : $this->beatmaps->pluck('playmode');

        return $rawPlaymodes->unique()->values();
    }

    public function playmodeCount()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->playmodes()->count();
        });
    }

    public function playmodesStr()
    {
        return array_map(
            static function ($ele) {
                return Beatmap::modeStr($ele);
            },
            $this->playmodes()->toArray()
        );
    }

    /**
     * Returns all the Rulesets that are eligible to be the main ruleset.
     * This will _not_ query the current beatmapset nominations if there is an existing value in `eligible_main_rulesets`
     *
     * @return string[]
     */
    public function eligibleMainRulesets(): array
    {
        $rulesets = $this->eligible_main_rulesets;

        if ($rulesets === null) {
            $rulesets = (new BeatmapsetMainRuleset($this))->currentEligibleSorted();
            $this->update(['eligible_main_rulesets' => $rulesets]);
        }

        return $rulesets;
    }

    /**
     * Returns the main Ruleset.
     * This calls `eligibleMainRulesets()` and has the same nomination querying behaviour.
     *
     * @return string|null returns the main Ruleset if there is one eligible Ruleset; `null`, otherwise.
     */
    public function mainRuleset(): ?string
    {
        $eligible = $this->eligibleMainRulesets();

        return count($eligible) === 1 ? $eligible[0] : null;
    }

    public function rankingQueueStatus()
    {
        if (!$this->isQualified()) {
            return;
        }

        $modes = $this->playmodes()->toArray();

        $queueSize = static::qualified()
            ->withModesForRanking($modes)
            ->where('queued_at', '<', $this->queued_at)
            ->count();
        $days = ceil($queueSize / $GLOBALS['cfg']['osu']['beatmapset']['rank_per_day']);

        $minDays = $GLOBALS['cfg']['osu']['beatmapset']['minimum_days_for_rank'] - $this->queued_at->diffInDays();
        $days = max($minDays, $days);

        return [
            'eta' => $days > 0 ? Carbon::now()->addDays($days) : null,
            'position' => $queueSize + 1,
        ];
    }

    public function disqualificationEvent()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->events()->disqualifications()->orderBy('created_at', 'desc')->first();
        });
    }

    public function resetEvent()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->events()->disqualificationAndNominationResetEvents()->orderBy('created_at', 'desc')->first();
        });
    }

    public function nominationsByType()
    {
        $nominations = $this->beatmapsetNominations()
            ->current()
            ->with('user')
            ->get();

        $result = [
            'full' => [],
            'limited' => [],
        ];

        foreach ($nominations as $nomination) {
            $userNominationModes = $nomination->user->nominationModes();
            // no permission
            if ($userNominationModes === null) {
                continue;
            }

            // legacy nomination, only check group
            if ($nomination->modes === null) {
                if ($nomination->user->isLimitedBN()) {
                    $result['limited'][] = null;
                } else if ($nomination->user->isBNG() || $nomination->user->isNAT()) {
                    $result['full'][] = null;
                }
            } else {
                foreach ($nomination->modes as $mode) {
                    $nominationType = $userNominationModes[$mode] ?? null;
                    if ($nominationType !== null) {
                        $result[$nominationType][] = $mode;
                    }
                }
            }
        }

        return $result;
    }

    public function status()
    {
        return array_search_null($this->approved, static::STATES);
    }

    public function defaultDiscussionJson()
    {
        $this->loadMissing([
            'allBeatmaps',
            'allBeatmaps.beatmapOwners.user',
            'allBeatmaps.user', // TODO: for compatibility only, should migrate user_id to BeatmapOwner.
            'beatmapDiscussions.beatmapDiscussionPosts',
            'beatmapDiscussions.beatmapDiscussionVotes',
        ]);

        foreach ($this->allBeatmaps as $beatmap) {
            $beatmap->setRelation('beatmapset', $this);
        }

        foreach ($this->beatmapDiscussions as $discussion) {
            // set relations for priv checks.
            $discussion->setRelation('beatmapset', $this);
            $beatmap = $this->allBeatmaps->find($discussion->beatmap_id);
            $discussion->setRelation('beatmap', $beatmap);
        }

        return json_item(
            $this,
            new BeatmapsetTransformer(),
            [
                'beatmaps:with_trashed.owners',
                'current_user_attributes',
                'discussions',
                'discussions.current_user_attributes',
                'discussions.posts',
                'discussions.votes',
                'eligible_main_rulesets',
                'events',
                'nominations',
                'related_users',
                'related_users.groups',
            ]
        );
    }

    public function defaultBeatmaps()
    {
        return $this->hasMany(Beatmap::class)->default();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approvedby_id');
    }

    public function descriptionPost()
    {
        return $this->hasOneThrough(
            Forum\Post::class,
            Forum\Topic::class,
            'topic_id',
            'post_id',
            'thread_id',
            'topic_first_post_id',
        );
    }

    public function topic()
    {
        return $this->belongsTo(Forum\Topic::class, 'thread_id');
    }

    public function track()
    {
        return $this->belongsTo(ArtistTrack::class);
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

        if ($this->relationLoaded('userRatings')) {
            foreach ($this->userRatings as $userRating) {
                $ratings[$userRating->rating]++;
            }
        } else {
            $userRatings = $this->userRatings()
                ->select('rating', \DB::raw('count(*) as count'))
                ->groupBy('rating')
                ->get();

            foreach ($userRatings as $rating) {
                $ratings[$rating->rating] = $rating->count;
            }
        }

        return $ratings;
    }

    public function favourites()
    {
        return $this->hasMany(FavouriteBeatmapset::class);
    }

    public function description()
    {
        return $this->getBBCode()?->toHTML();
    }

    public function editableDescription()
    {
        return $this->getBBCode()?->toEditor();
    }

    public function updateDescription($bbcode, $user)
    {
        $post = $this->descriptionPost;
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
        $post = $this->descriptionPost;

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

    public function getDisplayArtist(?User $user)
    {
        $profileCustomization = UserProfileCustomization::forUser($user);

        return $profileCustomization['beatmapset_title_show_original']
            ? $this->artist_unicode
            : $this->artist;
    }

    public function getDisplayTitle(?User $user)
    {
        $profileCustomization = UserProfileCustomization::forUser($user);

        return $profileCustomization['beatmapset_title_show_original']
            ? $this->title_unicode
            : $this->title;
    }

    public function freshHype()
    {
        return $this
            ->beatmapDiscussions()
            ->withoutTrashed()
            ->ofType('hype')
            ->count();
    }

    /**
     * Refreshes the cached values of the beatmapset.
     * Resetting eligible main rulesets should only be tiggered if a change to the beatmapset can cause the main ruleset to change,
     * or existing nominations are invalidated.
     */
    public function refreshCache(bool $resetEligibleMainRulesets = false): void
    {
        $this->update([
            'eligible_main_rulesets' => $resetEligibleMainRulesets ? null : (new BeatmapsetMainRuleset($this))->currentEligibleSorted(),
            'hype' => $this->freshHype(),
            'nominations' => $this->isLegacyNominationMode() ? $this->currentNominationCount() : array_sum(array_values($this->currentNominationCount())),
        ]);
    }

    public function afterCommit()
    {
        dispatch(new EsDocument($this));
    }

    public function notificationCover()
    {
        return $this->coverURL('card');
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'beatmapset';
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->isDirty('language_id') && ($this->language === null || $this->language_id === 0)) {
            $this->validationErrors()->add('language_id', 'invalid');
        }

        if ($this->isDirty('genre_id') && ($this->genre === null || $this->genre_id === 0)) {
            $this->validationErrors()->add('genre_id', 'invalid');
        }

        $this->validateDbFieldLengths();

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        return $this->isValid() && parent::save($options);
    }

    public function url()
    {
        return route('beatmapsets.show', $this);
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'UnwantedContent',
            'user_id' => $this->user_id,
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function ($builder) {
            $builder->active();
        });
    }

    private function defaultCoverTimestamp(): string
    {
        return $this->cover_updated_at?->format('U') ?? '0';
    }

    private function getArtistUnicode()
    {
        return $this->getRawAttribute('artist_unicode') ?? $this->artist;
    }

    private function getPackTags(): array
    {
        if (array_key_exists('pack_tags', $this->attributes)) {
            $rawValue = $this->attributes['pack_tags'];

            return $rawValue === null
                ? []
                : explode(',', $rawValue);
        }

        return $this->packs()->pluck('tag')->all();
    }

    private function getTitleUnicode()
    {
        return $this->getRawAttribute('title_unicode') ?? $this->title;
    }
}
