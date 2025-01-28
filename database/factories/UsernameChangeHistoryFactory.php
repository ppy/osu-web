<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;

class UsernameChangeHistoryFactory extends Factory
{
    protected $model = UsernameChangeHistory::class;

    public function definition(): array
    {
        return [
            'timestamp' => Carbon::now(),
            'type' => 'paid',
            'user_id' => User::factory(),

            // depend on user_id; the username will be incorrect when factorying multiple names at once,
            // so they should be handled separately if realistic name changes are wanted.
            'username' => fn (array $attr) => User::find($attr['user_id'])->username,
            'username_last' => fn (array $attr) => "{$attr['username']}_prev",
        ];
    }
}
