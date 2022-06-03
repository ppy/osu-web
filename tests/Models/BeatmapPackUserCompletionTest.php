<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Models\BeatmapPackItem;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Language;
use App\Models\Solo\Score;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use Tests\TestCase;

/**
 * @group EsSoloScores
 */
class BeatmapPackUserCompletionTest extends TestCase
{
    private static array $users;
    private static BeatmapPack $pack;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        (new static())->refreshApplication();
        $beatmap = Beatmap::factory()->ranked()->state([
            'playmode' => Beatmap::MODES['taiko'],
        ])->create();
        static::$pack = BeatmapPack::factory()->create();
        static::$pack->items()->create(['beatmapset_id' => $beatmap->beatmapset_id]);

        static::$users = [
            'convertOsu' => User::factory()->create(),
            'default' => User::factory()->create(),
            'null' => null,
            'unrelated' => User::factory()->create(),
        ];

        Score::factory()->create([
            'beatmap_id' => $beatmap,
            'ruleset_id' => Beatmap::MODES['osu'],
            'preserve' => true,
            'user_id' => static::$users['convertOsu'],
        ]);
        Score::factory()->create([
            'beatmap_id' => $beatmap,
            'preserve' => true,
            'user_id' => static::$users['default'],
        ]);

        static::reindexScores();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        (new static())->refreshApplication();
        Beatmap::truncate();
        BeatmapPack::truncate();
        BeatmapPackItem::truncate();
        Beatmapset::truncate();
        Country::truncate();
        Genre::truncate();
        Group::truncate();
        Language::truncate();
        Score::truncate();
        User::truncate();
        UserGroup::truncate();
        UserGroupEvent::truncate();
        (new ScoreSearch())->deleteAll();
    }

    protected $connectionsToTransact = [];

    /**
     * @dataProvider dataProviderForTestBasic
     */
    public function testBasic(string $userType, ?string $packRuleset, bool $completed): void
    {
        $user = static::$users[$userType];

        $rulesetId = $packRuleset === null ? null : Beatmap::MODES[$packRuleset];
        static::$pack->update(['playmode' => $rulesetId]);
        static::$pack->refresh();

        $data = static::$pack->userCompletionData($user);
        $this->assertSame($completed ? 1 : 0, count($data['beatmapset_ids']));
        $this->assertSame($completed, $data['completed']);
    }

    public function dataProviderForTestBasic(): array
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
