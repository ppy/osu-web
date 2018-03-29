<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

use Auth;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Beatmap;
use App\Models\User;
use Illuminate\Http\Request;

class BeatmapsetSearchRequestParams
{
    // all public because lazy.

    /** @var array */
    public $extra = [];
    /** @var int|null */
    public $genre = null;
    /** @var bool */
    public $includeConverts = false;
    /** @var int|null */
    public $language = null;
    /** @var int|null */
    public $mode = null;
    /** @var int|null */
    public $page = null;
    /** @var string|null */
    public $queryString = null;
    /** @var array */
    public $rank = [];
    /** @var bool */
    public $showRecommended = false;
    /** @var int */
    public $status = 0;
    /** @var int|null */
    public $size = null;
    /** @var Sort */
    public $sort = null;
    /** @var User */
    public $user = null;

    public function __construct(Request $request, User $user = null)
    {
        static $validExtras = ['video', 'storyboard'];
        static $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];

        $this->user = $user;
        $this->page = get_int($request['page']) ?? 1;

        if ($this->user !== null) {
            $this->queryString = es_query_escape_with_caveats($request['q'] ?? null);
            $this->status = get_int($request['s'] ?? null) ?? 0;
            $this->genre = get_int($request['g'] ?? null);
            $this->language = get_int($request['l'] ?? null);
            $this->extra = array_intersect(
                explode('.', $request['e'] ?? null),
                $validExtras
            );

            $this->mode = get_int($request['m']);
            if (!in_array($this->mode, Beatmap::MODES, true)) {
                $this->mode = null;
            }

            $generals = explode('.', $request['c'] ?? null) ?? [];
            $this->includeConverts = in_array('converts', $generals, true);
            $this->showRecommended = in_array('recommended', $generals, true);

            if ($this->user->isSupporter()) {
                $this->rank = array_intersect(
                    explode('.', $request['r'] ?? null),
                    $validRanks
                );
            }
        }

        $sort = explode('_', $request['sort']);
        $this->sort = new Sort($sort[0] ?? null, $sort[1] ?? null);
    }
}
