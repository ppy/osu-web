<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Exceptions\InvariantException;
use App\Libraries\User\CountryChange;
use App\Models\Beatmap;
use App\Models\Country;
use App\Models\Score\Best\Model as ScoreBestModel;
use App\Models\User;
use Tests\TestCase;

class CountryChangeTest extends TestCase
{
    /**
     * @group RequiresScoreIndexer
     */
    public function testDo(): void
    {
        $user = User::factory();
        foreach (Beatmap::MODES as $ruleset => $_rulesetId) {
            $user = $user->withPlays(rand(1, 20), $ruleset);
        }
        $user = $user->create();
        foreach (Beatmap::MODES as $ruleset => $_rulesetId) {
            ScoreBestModel
                ::getClass($ruleset)
                ::factory(['user_id' => $user, 'country_acronym' => $user->country_acronym])
                ->count(rand(1, 5))
                ->create();
        }
        $targetCountry = Country::factory()->create()->getKey();

        $this->expectCountChange(fn () => $user->accountHistories()->count(), 1);
        CountryChange::handle($user, $targetCountry, 'test');

        $user->refresh();
        $this->assertSame($user->country_acronym, $targetCountry);
        foreach (Beatmap::MODES as $ruleset => $_rulesetId) {
            $this->assertSame($user->statistics($ruleset)->country_acronym, $targetCountry);

            foreach (Beatmap::VARIANTS[$ruleset] ?? [] as $variant) {
                $this->assertSame(
                    $user->statistics($ruleset, false, $variant)->country_acronym,
                    $targetCountry,
                );
            }

            $scores = ScoreBestModel::getClass($ruleset)::where(['user_id' => $user->getKey()])->get();
            foreach ($scores as $score) {
                $this->assertSame($score->country_acronym, $targetCountry);
            }
        }

        // TODO: add test for solo score country change (in es index)
    }

    public function testDoInvalidCountry(): void
    {
        $user = User::factory()->create();
        $oldCountry = $user->country_acronym;

        $this->expectException(InvariantException::class);
        CountryChange::handle($user, '__', 'test');
    }
}
