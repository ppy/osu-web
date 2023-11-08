<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\ScoreToken;
use App\Models\User;
use Tests\TestCase;

class ScoreTokensControllerTest extends TestCase
{
    private Build $build;
    private User $user;

    /**
     * @dataProvider dataProviderForTestStore
     */
    public function testStore(string $beatmapState, int $status): void
    {
        $beatmap = Beatmap::factory()->$beatmapState()->create();

        $routeParams = [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ];
        $bodyParams = [
            'beatmap_hash' => $beatmap->checksum,
            'version_hash' => bin2hex($this->build->hash),
        ];

        $this->expectCountChange(fn () => ScoreToken::count(), $status >= 200 && $status < 300 ? 1 : 0);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.beatmaps.solo.score-tokens.store', $routeParams),
            $bodyParams
        )->assertStatus($status);
    }

    /**
     * @dataProvider dataProviderForTestStoreInvalidParameter
     */
    public function testStoreInvalidParameter(string $paramKey, ?string $paramValue, int $status): void
    {
        $beatmap = Beatmap::factory()->ranked()->create();

        $this->actAsScopedUser($this->user, ['*']);

        $params = [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'version_hash' => bin2hex($this->build->hash),
            'beatmap_hash' => $beatmap->checksum,
        ];
        $params[$paramKey] = $paramValue;

        $routeParams = [
            'beatmap' => $params['beatmap'],
            'ruleset_id' => $params['ruleset_id'],
        ];
        $bodyParams = [
            'beatmap_hash' => $params['beatmap_hash'],
            'version_hash' => $params['version_hash'],
        ];

        $this->expectCountChange(fn () => ScoreToken::count(), 0);

        $errorMessage = $paramValue === null ? 'missing' : 'invalid';
        $errorMessage .= ' ';
        $errorMessage .= $paramKey === 'version_hash'
            ? ($paramValue === null
                ? 'client version'
                : 'client hash'
            ) : $paramKey;

        $this->json(
            'POST',
            route('api.beatmaps.solo.score-tokens.store', $routeParams),
            $bodyParams
        )->assertStatus($status)
        ->assertJson([
            'error' => $errorMessage,
        ]);
    }

    public function dataProviderForTestStore(): array
    {
        return [
            ['deleted', 404],
            ['deletedBeatmapset', 404],
            ['inactive', 404],
            ['ranked', 200],
            ['wip', 200],
        ];
    }

    public function dataProviderForTestStoreInvalidParameter(): array
    {
        return [
            'invalid build hash' => ['version_hash', md5('invalid_'), 422],
            'missing build hash' => ['version_hash', null, 422],

            'invalid ruleset id' => ['ruleset_id', '5', 422],
            'missing ruleset id' => ['ruleset_id', null, 422],

            'invalid beatmap hash' => ['beatmap_hash', 'xxx', 422],
            'missing beatmap hash' => ['beatmap_hash', null, 422],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->build = Build::factory()->create(['allow_ranking' => true]);
    }
}
