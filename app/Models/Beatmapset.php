<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\BeatmapProcessorException;
use App\Exceptions\InvariantException;
use App\Jobs\CheckBeatmapsetCovers;
use App\Jobs\EsIndexDocument;
use App\Jobs\Notifications\BeatmapsetDiscussionLock;
use App\Jobs\Notifications\BeatmapsetDiscussionUnlock;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetLove;
use App\Jobs\Notifications\BeatmapsetNominate;
use App\Jobs\Notifications\BeatmapsetQualify;
use App\Jobs\Notifications\BeatmapsetRank;
use App\Jobs\Notifications\BeatmapsetRemoveFromLoved;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Jobs\RemoveBeatmapsetBestScores;
use App\Libraries\BBCodeFromDB;
use App\Libraries\Commentable;
use App\Libraries\Elasticsearch\Indexable;
use App\Libraries\ImageProcessorService;
use App\Libraries\StorageWithUrl;
use App\Libraries\Transactions\AfterCommit;
use App\Traits\CommentableDefaults;
use App\Traits\Memoizes;
use App\Traits\Validatable;
use Cache;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;

/**
 * @property bool $active
 * @property \Illuminate\Database\Eloquent\Collection $allBeatmaps Beatmap
 * @property int $approved
 * @property \Carbon\Carbon|null $approved_date
 * @property int|null $approvedby_id
 * @property User $approver
 * @property string $artist
 * @property string $artist_unicode
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussions BeatmapDiscussion
 * @property \Illuminate\Database\Eloquent\Collection $beatmaps Beatmap
 * @property int $beatmapset_id
 * @property mixed|null $body_hash
 * @property float $bpm
 * @property string $commentable_identifier
 * @property Comment $comments
 * @property \Carbon\Carbon|null $cover_updated_at
 * @property string $creator
 * @property \Illuminate\Database\Eloquent\Collection $defaultBeatmaps Beatmap
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $difficulty_names
 * @property bool $discussion_enabled
 * @property bool $discussion_locked
 * @property string $displaytitle
 * @property bool $download_disabled
 * @property string|null $download_disabled_url
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
 * @property int $star_priority
 * @property bool $storyboard
 * @property \Carbon\Carbon|null $submit_date
 * @property string $tags
 * @property \Carbon\Carbon|null $thread_icon_date
 * @property int $thread_id
 * @property string $title
 * @property string $title_unicode
 * @property User $user
 * @property \Illuminate\Database\Eloquent\Collection $userRatings BeatmapsetUserRating
 * @property int $user_id
 * @property int $versions_available
 * @property bool $video
 * @property \Illuminate\Database\Eloquent\Collection $watches BeatmapsetWatch
 */
class Beatmapset extends Model implements AfterCommit, Commentable, Indexable
{
    use CommentableDefaults, Elasticsearch\BeatmapsetTrait, Memoizes, SoftDeletes, Validatable;

    protected $_storage = null;
    protected $table = 'osu_beatmapsets';
    protected $primaryKey = 'beatmapset_id';

    protected $casts = [
        'active' => 'boolean',
        'download_disabled' => 'boolean',
        'epilepsy' => 'boolean',
        'nsfw' => 'boolean',
        'storyboard' => 'boolean',
        'video' => 'boolean',
        'discussion_enabled' => 'boolean',
        'discussion_locked' => 'boolean',
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

    public static function isValidCoverSize($coverSize)
    {
        $validSizes = array_merge(['raw', 'fullsize'], self::coverSizes());

        return in_array($coverSize, $validSizes, true);
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
            $ranked = self::ranked()->active()->orderBy('approved_date', 'desc')->limit($count);
            $approved = self::approved()->active()->orderBy('approved_date', 'desc')->limit($count);

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

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
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
        $time = $this->beatmapDiscussions()->max('updated_at');

        if ($time !== null) {
            return Carbon::parse($time);
        }
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
        foreach (self::coverSizes() as $size) {
            $urls[$size] = $this->coverURL($size);
        }

        return $urls;
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

        $contents = file_get_contents($url);
        if ($contents === false) {
            throw new BeatmapProcessorException('Error retrieving beatmap');
        }

        $bytesWritten = fwrite($oszFile, $contents);

        if ($bytesWritten === false) {
            throw new BeatmapProcessorException('Failed writing stream');
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
        $oldScoreable = $this->isScoreable();

        if ($this->isQualified() && $state === 'pending') {
            $this->previous_queue_duration = ($this->queued_at ?? $this->approved_date)->diffinSeconds();
            $this->queued_at = null;
        } elseif ($this->isPending() && $state === 'qualified') {
            $maxAdjustment = (config('osu.beatmapset.minimum_days_for_rank') - 1) * 24 * 3600;
            $adjustment = min($this->previous_queue_duration, $maxAdjustment);
            $this->queued_at = $currentTime->copy()->subSeconds($adjustment);
        }

        $this->approved = static::STATES[$state];

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

        $this
            ->beatmaps()
            ->update(['approved' => $this->approved]);

        if ($this->isScoreable() !== $oldScoreable || $this->isRanked()) {
            dispatch(new RemoveBeatmapsetBestScores($this));
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

    public function disqualifyOrResetNominations(User $user, BeatmapDiscussion $post)
    {
        $event = BeatmapsetEvent::DISQUALIFY;
        $notificationClass = BeatmapsetDisqualify::class;
        if ($this->isPending()) {
            $event = BeatmapsetEvent::NOMINATION_RESET;
            $notificationClass = BeatmapsetResetNominations::class;
        } else if (!$this->isQualified()) {
            throw new InvariantException('invalid state');
        }

        $this->getConnection()->transaction(function () use ($event, $notificationClass, $post, $user) {
            // call resetNominations?
            $nominators = $this->nominationsSinceReset()->with('user')->get()->pluck('user');
            BeatmapsetEvent::log($event, $user, $post, ['nominator_ids' => $nominators->pluck('user_id')])->saveOrExplode();
            foreach ($nominators as $nominator) {
                $params = ['source_user_id' => $user->getKey(), 'source_user_username' => $user->username];
                BeatmapsetEvent::log(BeatmapsetEvent::NOMINATION_RESET_RECEIVED, $nominator, $post, $params)->saveOrExplode();
            }

            if ($event === BeatmapsetEvent::DISQUALIFY) {
                $this->setApproved('pending', $user);
            }

            $this->refreshCache();

            (new $notificationClass($this, $user))->dispatch();
        });
    }

    public function resetNominations(User $user, BeatmapDiscussion $post)
    {
        $this->getConnection()->transaction(function () use ($user, $post) {
            $nominators = $this->nominationsSinceReset()->with('user')->get()->pluck('user');
            BeatmapsetEvent::log(BeatmapsetEvent::NOMINATION_RESET, $user, $post, ['nominator_ids' => $nominators->pluck('user_id')])->saveOrExplode();
            foreach ($nominators as $nominator) {
                BeatmapsetEvent::log(BeatmapsetEvent::NOMINATION_RESET_RECEIVED, $nominator, $post, ['source_user_id' => $user->getKey()])->saveOrExplode();
            }

            $this->refreshCache();

            (new BeatmapsetResetNominations($this, $user))->dispatch();
        });
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

            // enqueue a cover check job to ensure cover images are all present
            $job = (new CheckBeatmapsetCovers($this))->onQueue('beatmap_high');
            dispatch($job);

            (new BeatmapsetQualify($this, $user))->dispatch();
        });

        return true;
    }

    public function nominate(User $user, array $playmodes = [])
    {
        try {
            $this->resetMemoized(); // ensure we're not using cached/stale event data

            if (!$this->isPending()) {
                throw new InvariantException(trans('beatmaps.nominations.incorrect_state'));
            }

            if ($this->hype < $this->requiredHype()) {
                throw new InvariantException(trans('beatmaps.nominations.not_enough_hype'));
            }

            // check if there are any outstanding issues still
            if ($this->beatmapDiscussions()->openIssues()->count() > 0) {
                throw new InvariantException(trans('beatmaps.nominations.unresolved_issues'));
            }

            if ($this->isLegacyNominationMode()) {
                // in legacy mode, we check if a user can nominate for _any_ of the beatmapset's playmodes
                $canNominate = false;
                $canFullNominate = false;
                foreach ($this->playmodesStr() as $mode) {
                    if ($user->isFullBN($mode) || $user->isNAT($mode)) {
                        $canNominate = true;
                        $canFullNominate = true;
                    } else if ($user->isLimitedBN($mode)) {
                        $canNominate = true;
                    }
                }

                if (!$canNominate) {
                    throw new InvariantException(trans('beatmapsets.nominate.incorrect_mode', ['mode' => implode(', ', $this->playmodesStr())]));
                }

                if (!$canFullNominate && $this->requiresFullBNNomination()) {
                    throw new InvariantException(trans('beatmapsets.nominate.full_bn_required'));
                }
            } else {
                $playmodes = array_values(array_intersect($this->playmodesStr(), $playmodes));

                if (empty($playmodes)) {
                    throw new InvariantException(trans('beatmapsets.nominate.hybrid_requires_modes'));
                }

                foreach ($playmodes as $mode) {
                    if (!$user->isFullBN($mode) && !$user->isNAT($mode)) {
                        if (!$user->isLimitedBN($mode)) {
                            throw new InvariantException(trans('beatmapsets.nominate.incorrect_mode', ['mode' => $mode]));
                        }

                        if ($this->requiresFullBNNomination($mode)) {
                            throw new InvariantException(trans('beatmapsets.nominate.full_bn_required'));
                        }
                    }
                }
            }

            $nomination = $this->nominationsSinceReset()->where('user_id', $user->user_id);
            if (!$nomination->exists()) {
                $event = [
                    'type' => BeatmapsetEvent::NOMINATE,
                    'user_id' => $user->user_id,
                ];
                if (!$this->isLegacyNominationMode()) {
                    $event['comment'] = ['modes' => $playmodes];
                }
                $this->events()->create($event);

                if ($this->isLegacyNominationMode()) {
                    $shouldQualify = $this->currentNominationCount() >= $this->requiredNominationCount();
                } else {
                    $currentNominations = $this->currentNominationCount();
                    $requiredNominations = $this->requiredNominationCount();

                    $modesSatisfied = 0;
                    foreach ($requiredNominations as $mode => $count) {
                        if ($currentNominations[$mode] > $count) {
                            throw new InvariantException(trans('beatmaps.nominations.too_many'));
                        }

                        if ($currentNominations[$mode] === $count) {
                            $modesSatisfied++;
                        }
                    }
                    $shouldQualify = $modesSatisfied >= $this->playmodeCount();
                }

                if ($shouldQualify) {
                    $this->getConnection()->transaction(function () use ($user) {
                        return static::lockForUpdate()->find($this->getKey())->qualify($user);
                    });
                    $this->refresh();
                } else {
                    (new BeatmapsetNominate($this, $user))->dispatch();
                }
            }

            $this->refresh();
            $this->refreshCache();

            return [
                'result' => true,
            ];
        } catch (\Exception $e) {
            return [
                'result' => false,
                'message' => $e->getMessage(),
            ];
        }
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
                'message' => trans('beatmaps.nominations.incorrect_state'),
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
        if (!$this->isQualified()) {
            return false;
        }

        DB::transaction(function () {
            $this->events()->create(['type' => BeatmapsetEvent::RANK]);

            $this->update(['play_count' => 0]);
            $this->beatmaps()->update(['playcount' => 0, 'passcount' => 0]);
            $this->setApproved('ranked', null);

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

    public function beatmaps()
    {
        return $this->hasMany(Beatmap::class);
    }

    public function allBeatmaps()
    {
        return $this->hasMany(Beatmap::class)->withTrashed();
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

    public function requiredHype()
    {
        return config('osu.beatmapset.required_hype');
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
                'message' => trans("model_validation.beatmapset_discussion.hype.{$message}"),
            ];
        } else {
            return ['result' => true];
        }
    }

    public function requiredNominationCount($summary = false)
    {
        $playmodeCount = $this->playmodeCount();
        $baseRequirement = $playmodeCount === 1
            ? config('osu.beatmapset.required_nominations')
            : config('osu.beatmapset.required_nominations_hybrid');

        if ($summary || $this->isLegacyNominationMode()) {
            return $playmodeCount * $baseRequirement;
        }

        $requiredNominations = [];
        foreach ($this->playmodesStr() as $playmode) {
            $requiredNominations[$playmode] = $baseRequirement;
        }

        return $requiredNominations;
    }

    public function currentNominationCount()
    {
        if ($this->isLegacyNominationMode()) {
            return $this->nominationsSinceReset()->count();
        }

        $currentNominations = [];
        foreach ($this->playmodesStr() as $playmode) {
            $currentNominations[$playmode] = 0;
        }

        $nominations = $this->nominationsSinceReset()->get();
        foreach ($nominations as $nomination) {
            foreach ($nomination->nominationModes as $nomMode) {
                if (!isset($currentNominations[$nomMode])) {
                    continue;
                }

                $currentNominations[$nomMode] = $currentNominations[$nomMode] ?? 0;
                $currentNominations[$nomMode]++;
            }
        }

        return $currentNominations;
    }

    public function nominationsMeta()
    {
        return $this->memoize(__FUNCTION__, function () {
            return [
                'legacy_mode' => $this->isLegacyNominationMode(),
                'current' => $this->currentNominationCount(),
                'required' => $this->requiredNominationCount(),
            ];
        });
    }

    public function nominationsSummaryMeta()
    {
        return [
            'current' => $this->nominations,
            'required' => $this->requiredNominationCount(true),
        ];
    }

    public function isLegacyNominationMode()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->nominationsSinceReset()->whereNull('comment')->exists();
        });
    }

    public function hasNominations()
    {
        return $this->nominationsSinceReset()->exists();
    }

    public function playmodes()
    {
        return $this->beatmaps->pluck('playmode')->unique()->values();
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
        $days = ceil($queueSize / config('osu.beatmapset.rank_per_day'));

        $minDays = config('osu.beatmapset.minimum_days_for_rank') - $this->queued_at->diffInDays();
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

    public function hasFullBNNomination($mode = null)
    {
        return $this->nominationsSinceReset()
            ->with('user')
            ->get()
            ->pluck('user')
            ->contains(function ($user) use ($mode) {
                return $user->isNAT($mode) || $user->isFullBN($mode);
            });
    }

    public function requiresFullBNNomination($mode = null)
    {
        if ($this->isLegacyNominationMode()) {
            return $this->currentNominationCount() === $this->requiredNominationCount() - 1
                && !$this->hasFullBNNomination();
        }

        return $this->currentNominationCount()[$mode] === $this->requiredNominationCount()[$mode] - 1
            && !$this->hasFullBNNomination($mode);
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
                'allBeatmaps.beatmapset',
                'beatmapDiscussions.beatmapDiscussionPosts',
                'beatmapDiscussions.beatmapDiscussionVotes',
                'beatmapDiscussions.beatmapset',
                'beatmapDiscussions.beatmap',
                'beatmapDiscussions.beatmapDiscussionVotes',
            ])->find($this->getKey()),
            'Beatmapset',
            [
                'beatmaps:with_trashed',
                'current_user_attributes',
                'discussions',
                'discussions.current_user_attributes',
                'discussions.posts',
                'discussions.votes',
                'events',
                'events.nomination_modes',
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
        return $this->belongsTo(User::class, 'user_id', 'approvedby_id');
    }

    public function topic()
    {
        return $this->belongsTo(Forum\Topic::class, 'thread_id');
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

    public function getArtistUnicodeAttribute($value)
    {
        return $value ?? $this->artist;
    }

    public function getDisplayArtist(?User $user)
    {
        $profileCustomization = $user->userProfileCustomization ?? new UserProfileCustomization();
        if ($profileCustomization->beatmapset_title_show_original) {
            return $this->artist_unicode;
        }

        return $this->artist;
    }

    public function getDisplayTitle(?User $user)
    {
        $profileCustomization = $user->userProfileCustomization ?? new UserProfileCustomization();
        if ($profileCustomization->beatmapset_title_show_original) {
            return $this->title_unicode;
        }

        return $this->title;
    }

    public function getPost()
    {
        $topic = $this->topic;

        if ($topic === null) {
            return;
        }

        return Forum\Post::find($topic->topic_first_post_id);
    }

    public function getTitleUnicodeAttribute($value)
    {
        return $value ?? $this->title;
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
            'nominations' => $this->isLegacyNominationMode() ? $this->currentNominationCount() : array_sum(array_values($this->currentNominationCount())),
        ]);
    }

    public function afterCommit()
    {
        dispatch(new EsIndexDocument($this));
    }

    public function notificationCover()
    {
        return $this->coverURL('card');
    }

    public function validationErrorsTranslationPrefix()
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function ($builder) {
            $builder->active();
        });
    }
}
