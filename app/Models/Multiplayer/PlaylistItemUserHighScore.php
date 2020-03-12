<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Models\Model;

/**
 * Dumb persistence model for UserScoreAggregate.
 *
 * @property float $accuracy
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int $playlist_item_id
 * @property float|null $pp
 * @property int $score_id
 * @property int $total_score
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class PlaylistItemUserHighScore extends Model
{
    protected $table = 'multiplayer_scores_high';
}
