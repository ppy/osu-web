<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Solo\ScoreToken;
use App\Models\User;
use Tests\TestCase;

class ScoreTokensControllerTest extends TestCase
{
    /**
     * @dataProvider storeDataProvider
     */
    public function testStore($beatmapState, $passRulesetId, $hashParam, $status)
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states($beatmapState)->create();
        $build = Build::factory()->create(['allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $routeParams = ['beatmap' => $beatmap->getKey()];
        if ($passRulesetId) {
            $routeParams['ruleset_id'] = $beatmap->playmode;
        }

        $bodyParams = [];
        if ($hashParam !== null) {
            $bodyParams['version_hash'] = $hashParam ? bin2hex($build->hash) : md5('invalid_');
        }

        $this->json(
            'POST',
            route('api.beatmaps.solo.score-tokens.store', $routeParams),
            $bodyParams
        )->assertStatus($status);

        $countDiff = ((string) $status)[0] === '2' ? 1 : 0;

        $this->assertSame($initialScoreTokenCount + $countDiff, ScoreToken::count());
    }

    public function storeDataProvider()
    {
        return [
            'ok' => ['ranked', true, true, 200],
            'pending beatmap' => ['wip', true, true, 404],
            'missing ruleset id' => ['ranked', false, true, 422],
            'invalid hash' => ['ranked', true, false, 422],
        ];
    }
}
