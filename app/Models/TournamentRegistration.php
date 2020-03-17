<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property int $registration_id
 * @property Tournament $tournament
 * @property int $tournament_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class TournamentRegistration extends Model
{
    protected $primaryKey = 'registration_id';

    public function getDates()
    {
        return ['created_at', 'updated_at', 'signup_open', 'signup_close', 'start_date', 'end_date'];
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
