<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Notification;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;

class TeamApplicationAccept extends BroadcastNotificationBase
{
    const DELIVERY_MODE_DEFAULTS = ['mail' => true, 'push' => true];

    private Team $team;
    private int $userId;

    public static function getMailLink(Notification $notification): string
    {
        return route('teams.show', ['team' => $notification->notifiable_id]);
    }

    public function __construct(TeamMember $member, User $source)
    {
        $this->team = $member->team;
        $this->userId = $member->user_id;

        parent::__construct($source);
    }

    public function getDetails(): array
    {
        return [
            'cover_url' => $this->team->logo()->url(),
            'team_id' => $this->team->getKey(),
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
