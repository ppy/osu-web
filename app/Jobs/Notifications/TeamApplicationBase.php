<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Notification;
use App\Models\Team;
use App\Models\TeamApplication;
use App\Models\User;

abstract class TeamApplicationBase extends BroadcastNotificationBase
{
    const DELIVERY_MODE_DEFAULTS = ['mail' => false, 'push' => true];

    protected Team $team;
    protected int $userId;

    public static function getMailLink(Notification $notification): string
    {
        return route('teams.show', ['team' => $notification->notifiable_id]);
    }

    public function __construct(TeamApplication $application, User $source)
    {
        $this->team = $application->team;
        $this->userId = $application->getKey();

        parent::__construct($source);
    }

    public function getDetails(): array
    {
        return [
            'cover_url' => $this->team->flag()->url(),
            'title' => $this->team->name,
        ];
    }

    public function getListeningUserIds(): array
    {
        return [$this->userId];
    }

    public function getNotifiable()
    {
        return $this->team;
    }
}
