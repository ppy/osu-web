<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Models\Score\Best as ScoreBest;
use App\Models\User;
use Tests\TestCase;

class BeatmapPackUserCompletionTest extends TestCase
{
    /**
     * @dataProvider dataProviderForTestBasic
     */
    public function testBasic(string $userType, ?string $packRuleset, bool $completed): void
    {
        $beatmap = Beatmap::factory()->ranked()->state([
            'playmode' => Beatmap::MODES['taiko'],
        ])->create();
        $pack = BeatmapPack::factory()->create();
        $pack->items()->create(['beatmapset_id' => $beatmap->beatmapset_id]);

        $scoreUser = User::factory()->create();
        $scoreClass = ScoreBest\Taiko::class;
        switch ($userType) {
            case 'convertOsu':
                $checkUser = $scoreUser;
                $scoreClass = ScoreBest\Osu::class;
                break;
            case 'default':
                $checkUser = $scoreUser;
                break;
            case 'null':
                $checkUser = null;
                break;
            case 'unrelated':
                $checkUser = User::factory()->create();
                break;
        }

        $scoreClass::factory()->create([
            'beatmap_id' => $beatmap,
            'user_id' => $scoreUser->getKey(),
        ]);

        $rulesetId = $packRuleset === null ? null : Beatmap::MODES[$packRuleset];
        $pack->update(['playmode' => $rulesetId]);
        $pack->refresh();

        $data = $pack->userCompletionData($checkUser);
        $this->assertSame($completed ? 1 : 0, count($data['beatmapset_ids']));
        $this->assertSame($completed, $data['completed']);
    }

    public static function dataProviderForTestBasic(): array
    {
        return [
            ['convertOsu', 'osu', true],
            ['convertOsu', 'taiko', false],
            ['convertOsu', null, false],
            ['default', 'osu', false],
            ['default', 'taiko', true],
            ['default', null, true],
            ['null', 'osu', false],
            ['null', 'taiko', false],
            ['null', null, false],
            ['unrelated', 'osu', false],
            ['unrelated', 'taiko', false],
            ['unrelated', null, false],
        ];
    }
}
