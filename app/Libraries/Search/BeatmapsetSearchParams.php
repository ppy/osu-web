<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Models\Beatmap;

class BeatmapsetSearchParams extends SearchParams
{
    const BUNDLED_STATES = ['currently', 'previously', 'never'];
    const PLAYED_STATES = ['played', 'unplayed'];
    const STATUSES_NO_CACHE = ['favourites', 'mine'];

    public ?array $accuracy = null;

    /** @var array|null */
    public $ar;

    /** @var string|null */
    public $artist;

    /** @var array|null */
    public $bpm;

    /**
     * null means any state.
     *
     * @var string|null
     */
    public $bundledFilter = null;

    /** @var array|null */
    public $created;

    /** @var string|null */
    public $creator;

    /** @var array|null */
    public $cs;

    /** @var array|null */
    public $difficultyRating;

    /** @var array|null */
    public $drain;

    /** @var array */
    public $extra = [];

    /** @var int|null */
    public $genre = null;

    /** @var bool */
    public $includeConverts = false;

    /** @var bool */
    public $includeNsfw = false;

    /** @var array|null */
    public $keys;

    /** @var int|null */
    public $language = null;

    /** @var int|null */
    public $mode = null;

    /**
     * null means any state.
     *
     * @var string|null
     */
    public $playedFilter = null;

    /** @var string|null */
    public $queryString = null;

    /** @var array */
    public $rank = [];

    /** @var array|null */
    public $ranked;

    /** @var bool */
    public $showFollows = false;

    /** @var bool */
    public $showRecommended = false;

    /** @var string|null */
    public $status = null;

    /** @var array|null */
    public $statusRange;

    /** @var array|null */
    public $hitLength;

    /** @var User|null */
    public $user = null;

    /** @var float|null */
    private $recommendedDifficulty;

    public function __construct()
    {
        parent::__construct();

        $this->size = config('osu.beatmaps.max');
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKeyVars(): array
    {
        $vars = parent::getCacheKeyVars();
        unset($vars['user']);

        return $vars;
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return !(
            present($this->queryString)
            || !empty($this->rank)
            || in_array($this->status, static::STATUSES_NO_CACHE, true)
            || $this->showRecommended
            || $this->playedFilter !== null
            || !empty($this->blockedUserIds()) // don't cache result if blocking applied, unless filter is moved client-side.
        );
    }

    /**
     * Gets the recommended star difficulty for the user for the selected game mode; null if the user is not logged in.
     *
     * @return float|null The recommended star difficulty; .
     */
    public function getRecommendedDifficulty(): ?float
    {
        if ($this->user === null) {
            return null;
        }

        if ($this->recommendedDifficulty === null) {
            $mode = Beatmap::modeStr($this->mode) ?? $this->user->playmode;
            $this->recommendedDifficulty = $this->user->recommendedStarDifficulty($mode);
        }

        return $this->recommendedDifficulty;
    }

    public function hasSupporterFeatures(): bool
    {
        return $this->playedFilter !== null || !empty($this->rank);
    }

    public function shouldReturnEmptyResponse(): bool
    {
        return !optional($this->user)->isSupporter() && $this->hasSupporterFeatures();
    }
}
