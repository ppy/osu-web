<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Libraries\Notification\BatchIdentities;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamApplication extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'user_id';

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Removal from applicant side
     */
    public function cancel(): bool
    {
        if (($notification = $this->notification) !== null) {
            UserNotification::batchDestroy(
                $this->team->leader_id,
                BatchIdentities::fromParams([
                    'notifications' => [$notification->toIdentityJson()],
                ]),
            );
        }

        return parent::delete();
    }
}
