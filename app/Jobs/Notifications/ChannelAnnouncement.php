<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs\Notifications;

use App\Models\Notification;

class ChannelAnnouncement extends ChannelMessageBase
{
    const DELIVERY_MODE_DEFAULTS = ['mail' => true, 'push' => true];

    public static function getBaseKey(Notification $notification): string
    {
        return 'channel.announcement.announce';
    }

    public function getDetails(): array
    {
        $channel = $this->message->channel;

        return [
            ...parent::getDetails(),
            'channel_id' => $channel->getKey(),
            'name' => $channel->name,
        ];
    }
}
