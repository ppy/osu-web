<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmap;
use App\Models\Notification;
use App\Models\User;

class BeatmapOwnerChange extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = Notification::BEATMAP_OWNER_CHANGE;

    protected $beatmap;
    protected $beatmapset;
    protected $user;

    public static function getMailLink(Notification $notification): string
    {
        return route('beatmapsets.discussion', [
            'beatmap' => '-',
            'beatmapset' => $notification->notifiable_id,
            'mode' => 'events',
        ]);
    }

    public function __construct(Beatmap $beatmap, User $source)
    {
        parent::__construct($source);

        $this->beatmap = $beatmap;
        $this->beatmapset = $beatmap->beatmapset;
        $this->user = $beatmap->user;
    }

    public function getDetails(): array
    {
        return [
            'beatmap_id' => $this->beatmap->getKey(),
            'cover_url' => $this->beatmapset->coverURL('card'),
            'title' => $this->beatmapset->title,
            'title_unicode' => $this->beatmapset->title_unicode,
            'version' => $this->beatmap->version,
        ];
    }

    public function getListeningUserIds(): array
    {
        return [$this->user->getKey()];
    }

    public function getNotifiable()
    {
        return $this->beatmapset;
    }

    public function getReceiverIds(): array
    {
        return $this->getListeningUserIds();
    }
}
