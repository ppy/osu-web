<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\UserAccountHistory;

class CountryChange
{
    public static function handle(User $user, string $newCountry, string $reason): void
    {
        // Assert valid country acronym
        $country = app('countries')->byCode($newCountry);
        if ($country === null) {
            throw new InvariantException('invalid country specified');
        }

        if ($user->country_acronym === $newCountry) {
            return;
        }

        $user->getConnection()->transaction(function () use ($newCountry, $reason, $user) {
            $oldCountry = $user->country_acronym;

            $newAttrs = ['country_acronym' => $newCountry];
            $user->update($newAttrs);
            foreach (Beatmap::MODES as $ruleset => $_rulesetId) {
                $user->statistics($ruleset, true)->update($newAttrs);
                $user->scoresBest($ruleset, true)->update($newAttrs);
                foreach (Beatmap::VARIANTS[$ruleset] ?? [] as $variant) {
                    $user->statistics($ruleset, true, $variant)->update($newAttrs);
                }
            }

            UserAccountHistory::addNote($user, "Changing country from {$oldCountry} to {$newCountry} ({$reason})");
        });

        \Artisan::queue('es:index-scores:queue', [
            '--all' => true,
            '--no-interaction' => true,
            '--user' => $user->getKey(),
        ]);
    }
}
