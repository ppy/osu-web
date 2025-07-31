<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Search\BeatmapsetSearch;
use App\Libraries\Search\BeatmapsetSearchParams;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;
use App\Models\UserGroup;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected static iterable $beatmapsets;

    abstract public static function dataProvider(): array;

    public static function setUpBeforeClass(): void
    {
        static::deleteAllEsBeatmapsets();
    }

    public static function tearDownAfterClass(): void
    {
        static::deleteAllEsBeatmapsets();
        static::withDbAccess(function () {
            Beatmap::truncate();
            Beatmapset::truncate();
            Country::truncate();
            Genre::truncate();
            Language::truncate();
            User::truncate();
            UserGroup::truncate();
        });

        static::$beatmapsets = [];
    }

    protected static function refresh(): void
    {
        Es::getClient()->indices()->refresh();
    }

    protected function setUp(): void
    {
        parent::setUp();
        config_set('osu.beatmapset.guest_advanced_search', true);
    }

    protected function searchAndAssert(array $params, array $expected): void
    {
        $beatmapsetIds = array_map(fn (int $index) => static::$beatmapsets[$index]->getKey(), $expected);

        $this->assertEqualsCanonicalizing($beatmapsetIds, new BeatmapsetSearch(new BeatmapsetSearchRequestParams($params))->response()->ids());
    }

    #[DataProvider('dataProvider')]
    public function testSearch(array $params, array $expected): void
    {
        $anyParams = new BeatmapsetSearchParams();
        $anyParams->status = 'any';
        $this->assertCount(count(static::$beatmapsets), new BeatmapsetSearch($anyParams)->response()->ids());

        $this->searchAndAssert($params, $expected);
    }
}
