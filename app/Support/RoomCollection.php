<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Support;

use App\Models\User;

class RoomCollection extends CollectionWithInjectedSelf
{
    private array $recentParticipantByUserId;

    /**
     * Using this requires the collection to be queried with withRecentParticipantIds scope.
     */
    public function recentParticipantByUserId(): array
    {
        if (!isset($this->recentParticipantByUserId)) {
            $allUserIds = array_flatten(array_column($this->items, 'recent_participant_ids'));

            $this->recentParticipantByUserId = User
                ::whereIntegerInRaw('user_id', $allUserIds)
                ->get()
                ->keyBy('user_id')
                ->all();
        }

        return $this->recentParticipantByUserId;
    }
}
