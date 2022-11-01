<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

        parent::__construct($attributes, false);
    }
}
