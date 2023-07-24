<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\Tournament;
use App\Models\TournamentRegistration;
use App\Models\User;
use App\Models\UserCountryHistory;
use Carbon\CarbonImmutable;

class CountryChangeTarget
{
    const MIN_DAYS_MONTH = 15;

    public static function currentMonth(): CarbonImmutable
    {
        $now = CarbonImmutable::now();
        $subMonths = $now->day > static::MIN_DAYS_MONTH ? 0 : 1;

        return $now->startOfMonth()->subMonths($subMonths);
    }

    public static function get(User $user): ?string
    {
        $minMonths = static::minMonths();
        $now = CarbonImmutable::now();
        $until = static::currentMonth();
        $since = $until->subMonths($minMonths - 1);

        if (static::isUserInTournament($user)) {
            return null;
        }

        $history = $user
            ->userCountryHistory()
            ->whereBetween('year_month', [
                UserCountryHistory::formatDate($since),
                UserCountryHistory::formatDate($until),
            ])->whereHas('country')
            ->get();

        // First group countries by year_month
        $byMonth = [];
        foreach ($history as $entry) {
            $byMonth[$entry->year_month] ??= [];
            $byMonth[$entry->year_month][] = $entry->country_acronym;
        }

        // For each year_month, summarise each countries
        $byCountry = [];
        foreach ($byMonth as $countries) {
            $mixed = count($countries) > 1;
            foreach ($countries as $country) {
                $byCountry[$country] ??= [
                    'total' => 0,
                    'mixed' => 0,
                ];
                $byCountry[$country]['total']++;
                if ($mixed) {
                    $byCountry[$country]['mixed']++;
                }
            }
        }

        // Finally find the first country which fulfills the requirement
        foreach ($byCountry as $country => $data) {
            if ($data['total'] === $minMonths && $data['mixed'] <= static::maxMixedMonths()) {
                if ($user->country_acronym === $country) {
                    return null;
                } else {
                    return $country;
                }
            }
        }

        return null;
    }

    public static function maxMixedMonths(): int
    {
        return config('osu.user.country_change.max_mixed_months');
    }

    public static function minMonths(): int
    {
        return config('osu.user.country_change.min_months');
    }

    private static function isUserInTournament(User $user): bool
    {
        return TournamentRegistration
            ::where('user_id', $user->getKey())
            ->whereIn(
                'tournament_id',
                Tournament
                    ::where('end_date', '>', CarbonImmutable::now())
                    ->orWhereNull('end_date')
                    ->select('tournament_id'),
            )->exists();
    }
}
