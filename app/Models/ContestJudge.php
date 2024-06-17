<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Contest $contest
 * @property int $contest_id
 * @property-read User $user
 * @property int $user_id
 */
class ContestJudge extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'contest_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
