<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\UserProfileCustomization;

class BeatmapsetSearchParams extends SearchParams
{
    const PLAYED_STATES = ['played', 'unplayed'];
    const STATUSES_NO_CACHE = ['favourites', 'mine'];

    public BeatmapsetSearchOptions $excludes;
    public array $extra = [];
    public ?int $genre = null;
    public BeatmapsetSearchOptions $includes;
    public bool $includeConverts = false;
    public bool $includeNsfw = UserProfileCustomization::DEFAULTS['beatmapset_show_nsfw'];
    public ?int $language = null;
    public ?int $mode = null;
    public ?string $playedFilter = null; // null means any state
    public array $rank = [];
    public bool $showFeaturedArtists = false;
    public bool $showFollows = false;
    public bool $showRecommended = false;
    public bool $showSpotlights = false;
    public ?string $status = null;
    public ?User $user = null;

    private ?float $recommendedDifficulty = null;

    public function __construct()
    {
        parent::__construct();

        $this->excludes = new BeatmapsetSearchOptions();
        $this->includes = new BeatmapsetSearchOptions();
        $this->size = $GLOBALS['cfg']['osu']['beatmaps']['max'];
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
