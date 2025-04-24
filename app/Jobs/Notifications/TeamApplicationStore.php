<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs\Notifications;

use App\Models\User;

class TeamApplicationStore extends TeamApplicationBase
{
    public function getListeningUserIds(): array
    {
        return [$this->team->leader_id];
    }

    public function getDetails(): array
    {
        return [
            ...parent::getDetails(),
            'title' => User::find($this->userId)?->username ?? '',
        ];
    }

    public function handle()
    {
        $currentAppllication = $this->team->applications()->firstWhere([
            'notification_id' => null,
            'user_id' => $this->userId,
        ]);

        if ($currentAppllication === null) {
            return null;
        }

        $data = parent::handle();

        if ($data !== null) {
            $currentAppllication->update(['notification_id' => $data['notification']->getKey()]);
        }

        return $data;
    }
}
