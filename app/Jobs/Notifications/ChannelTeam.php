<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs\Notifications;

use App\Models\Notification;

class ChannelTeam extends ChannelMessageBase
{
    const NOTIFICATION_OPTION_NAME = Notification::CHANNEL_TEAM;

    public function getDetails(): array
    {
        return [
            ...parent::getDetails(),
            'name' => $this->message->channel->name,
        ];
    }
}
