<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Models\Beatmap;

class BeatmapsetSearchParams extends SearchParams
{
    const PLAYED_STATES = ['played', 'unplayed'];

    /** @var array */
    public $extra = [];

    /** @var int|null */
    public $genre = null;

    /** @var bool */
    public $includeConverts = false;

    /**
     * null means any state.
     *
     * @var string
     */
    public $playedFilter = null;

    /** @var int|null */
    public $language = null;

    /** @var int|null */
    public $mode = null;

    /** @var string|null */
    public $queryString = null;

    /** @var array */
    public $rank = [];

    /** @var bool */
    public $showRecommended = false;

    /** @var int */
    public $status = 0;

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
    public function getCacheKey() : string
    {
        $vars = get_object_vars($this);
        unset($vars['user']);
        ksort($vars);

        return 'beatmapset-search:'.json_encode($vars);
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheable() : bool
    {
        return !(
            present($this->queryString)
            || !empty($this->rank)
            || in_array($this->status, [2, 6], true) // favourites, my maps.
            || $this->showRecommended
            || $this->playedFilter !== null
        );
    }

    /**
     * Gets the recommended star difficulty for the user for the selected game mode; null if the user is not logged in.
     *
     * @return float|null The recommended star difficulty; .
     */
    public function getRecommendedDifficulty() : ?float
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

    public function hasSupporterFeatures() : bool
    {
        return $this->playedFilter !== null || !empty($this->rank);
    }

    public function shouldReturnEmptyResponse() : bool
    {
        return !optional($this->user)->isSupporter() && $this->hasSupporterFeatures();
    }
}
