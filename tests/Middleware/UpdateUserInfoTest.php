<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Middleware;

use App\Models\OAuth\Client;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class UpdateUserInfoTest extends TestCase
{
    public function testClientBasic(): void
    {
        $user = User::factory()->create(['user_lastvisit' => Carbon::now()->subDays(1)]);
        $this->expectCountChange(fn () => $user->userCountryHistory()->count(), 1);

        $this->actAsClientUser($user);
        $this->get(route('api.me'));

        $this->assertTrue($user->fresh()->user_lastvisit->addSeconds(5)->isFuture());
    }

    public function testClientCountryHistoryTwiceNoDuplicateError(): void
    {
        $user = User::factory()->create(['user_lastvisit' => Carbon::now()->subDays(1)]);

        $countryAcronym = 'JP';
        $user->userCountryHistory()->create([
            'country_acronym' => $countryAcronym,
            'year_month' => format_month_column(new \DateTime()),
        ]);

        $this->expectCountChange(fn () => $user->userCountryHistory()->count(), 0);

        $this->actAsClientUser($user);
        $this
            ->withHeaders(['cf-ipcountry' => $countryAcronym])
            ->get(route('api.me'));
    }

    public function testClientDifferentCountry(): void
    {
        $user = User::factory()->create(['user_lastvisit' => Carbon::now()->subDays(1)]);

        $user->userCountryHistory()->create([
            'country_acronym' => 'JP',
            'year_month' => format_month_column(new \DateTime()),
        ]);

        $this->expectCountChange(fn () => $user->userCountryHistory()->count(), 1);

        $this->actAsClientUser($user);
        $this
            ->withHeaders(['cf-ipcountry' => 'AU'])
            ->get(route('api.me'));
    }

    private function actAsClientUser(User $user): void
    {
        $client = Client::factory()->create(['password_client' => true]);
        $this->actAsScopedUser($user, ['*'], $client);
    }
}
