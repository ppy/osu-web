<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property int $rank_delta
 * @property int $pp_delta
 */
class ScoreMetadata extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'score_id';
}
