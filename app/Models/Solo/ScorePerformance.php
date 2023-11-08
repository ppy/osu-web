<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Solo;

use App\Models\Model;

/**
 * @property int $score_id
 * @property float|null $pp
 */
class ScorePerformance extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'score_id';
    protected $table = 'score_performance';
}
