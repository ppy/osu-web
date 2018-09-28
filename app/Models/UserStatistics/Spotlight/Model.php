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

namespace App\Models\UserStatistics\Spotlight;

use App\Libraries\HasDynamicTable;
use App\Models\UserStatistics\Model as BaseModel;

abstract class Model extends BaseModel implements HasDynamicTable
{
    protected $connection = 'mysql-charts';

    public function __construct($attributes = [], $zeroInsteadOfNull = true)
    {
        if ($zeroInsteadOfNull) {
            $this->level = 1;

            $this->ranked_score = 0;

            $this->playcount = 0;
            $this->total_score = 0;
            $this->max_combo = 0;

            $this->count300 = 0;
            $this->count100 = 0;
            $this->count50 = 0;

            $this->replay_popularity = 0;

            $this->x_rank_count = 0;
            $this->s_rank_count = 0;
            $this->a_rank_count = 0;
        }

        return parent::__construct($attributes, false);
    }
}
