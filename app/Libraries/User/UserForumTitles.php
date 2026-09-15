<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\User;

class UserForumTitles
{
    public static function get(User $user): string
    {
        $count = $user->user_posts;
        return match (true) {
            $count < 5 => 'Rhythm Rookie',
            $count < 15 => 'Tempo Trainee',
            $count < 30 => 'Whistle Blower',
            $count < 50 => 'Cymbal Sounder',
            $count < 80 => 'Beat Clicker',
            $count < 120 => 'Slider Savant',
            $count < 180 => 'Spinner Sage',
            $count < 260 => 'Star Shooter',
            $count < 500 => 'Combo Commander',
            default => 'Rhythm Incarnate',
        };
    }
}
