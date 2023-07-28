<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Libraries\User\CountryChangeTarget;
use App\Models\Country;
use App\Models\Tournament;
use App\Models\User;
use Carbon\CarbonImmutable;
use Database\Factories\UserFactory;
use Tests\TestCase;

class CountryChangeTargetTest extends TestCase
{
    public function testGetNoData(): void
    {
        $user = User::factory()->create();

        $this->assertNull(CountryChangeTarget::get($user));
    }

    public function testGetNotEnoughMonths(): void
    {
        $user = User::factory()->create();
        $targetCountry = Country::factory()->create()->getKey();
        UserFactory::createRecentCountryHistory($user, $targetCountry, CountryChangeTarget::minMonths() - 1);

        $this->assertNull(CountryChangeTarget::get($user));
    }

    public function testGetEnoughMonths(): void
    {
        $user = User::factory()->create();
        $targetCountry = Country::factory()->create()->getKey();
        UserFactory::createRecentCountryHistory($user, $targetCountry, null);

        $this->assertSame($targetCountry, CountryChangeTarget::get($user));
    }

    public function testGetEnoughMonthsMixed(): void
    {
        $user = User::factory()->create();
        $targetCountry = Country::factory()->create()->getKey();
        UserFactory::createRecentCountryHistory($user, $targetCountry, null);
        UserFactory::createRecentCountryHistory($user, null, CountryChangeTarget::maxMixedMonths());

        $this->assertSame($targetCountry, CountryChangeTarget::get($user));
    }

    public function testGetEnoughMonthsMixedTooMany(): void
    {
        $user = User::factory()->create();
        $targetCountry = Country::factory()->create()->getKey();
        UserFactory::createRecentCountryHistory($user, $targetCountry, null);
        UserFactory::createRecentCountryHistory($user, null, CountryChangeTarget::maxMixedMonths() + 1);

        $this->assertNull(CountryChangeTarget::get($user));
    }

    public function testGetInRunningTournament(): void
    {
        $user = User::factory()->create();
        $targetCountry = Country::factory()->create()->getKey();
        UserFactory::createRecentCountryHistory($user, $targetCountry, null);
        $tournament = Tournament::factory()->create();
        $tournament->registrations()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->assertNull(CountryChangeTarget::get($user));
    }

    public function testGetInPastTournament(): void
    {
        $user = User::factory()->create();
        $targetCountry = Country::factory()->create()->getKey();
        UserFactory::createRecentCountryHistory($user, $targetCountry, null);
        $tournament = Tournament::factory()->create(['end_date' => CarbonImmutable::now()->subMonths(1)]);
        $tournament->registrations()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->assertSame($targetCountry, CountryChangeTarget::get($user));
    }
}
