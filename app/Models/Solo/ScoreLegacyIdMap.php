<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Models\Model;
use App\Models\User;

/**
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property \stdClass $data
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $id
 * @property bool $preserve
 * @property int $ruleset_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class ScoreLegacyIdMap extends Model
{
    protected $primaryKeys = ['ruleset_id', 'old_score_id'];
    protected $table = 'solo_scores_legacy_id_map';
}
