<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Models\Beatmap;
use App\Models\User;

class BeatmapsetSearchParams extends SearchParams
{
    const PLAYED_STATES = ['played', 'unplayed'];
    const STATUSES_NO_CACHE = ['favourites', 'mine'];

    public ?array $accuracy = null;
    public ?array $ar = null;
    public ?string $artist = null;
    public ?array $bpm = null;
    public ?array $created = null;
    public ?string $creator = null;
    public ?array $cs = null;
    public ?array $difficultyRating = null;
    public ?array $drain = null;
    public array $extra = [];
    public ?int $featuredArtist = null;
    public ?int $genre = null;
    public bool $includeConverts = false;
    public bool $includeNsfw = false;
    public ?array $keys = null;
    public ?int $language = null;
    public ?int $mode = null;
    public ?string $playedFilter = null; // null means any state
    public ?string $queryString = null;
    public array $rank = [];
    public ?array $ranked = null;
    public bool $showFeaturedArtists = false;
    public bool $showFollows = false;
    public bool $showRecommended = false;
    public ?string $status = null;
    public ?array $statusRange = null;
    public ?array $hitLength = null;
    public ?User $user = null;

    private ?float $recommendedDifficulty = null;

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
