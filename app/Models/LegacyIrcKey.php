<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property User $user
 * @property string $token
 * @property \Carbon\Carbon $timestamp
 */
class LegacyIrcKey extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = ['timestamp' => 'datetime'];
    protected $primaryKey = 'user_id';
    protected $table = 'osu_user_ircauth';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
