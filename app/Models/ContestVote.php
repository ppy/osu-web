<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Contest $contest
 * @property int $contest_entry_id
 * @property int $contest_id
 * @property \Carbon\Carbon|null $created_at
 * @property ContestEntry $entry
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 * @property float $weight
 */
class ContestVote extends Model
{
    public function entry()
    {
        return $this->belongsTo(ContestEntry::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
