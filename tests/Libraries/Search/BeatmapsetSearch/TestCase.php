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
    protected static iterable $beatmapsets = [];

    abstract public static function dataProvider(): array;

    /**
     * @afterClass
     * @beforeClass
     *
     * Should run before setUpBeforeClass.
     */
    public static function cleanupEsBeatmapsets(): void
    {
        static::deleteAllEsBeatmapsets();
    }

    public static function setUpBeforeClass(): void
    {
        $count = count(static::$beatmapsets);
        if ($count === 0) {
            throw new \Exception('No beatmapsets added to test setup.');
        }

        Es::getClient()->indices()->refresh();
        $params = new BeatmapsetSearchParams();
        $params->status = 'any';

        if (new BeatmapsetSearch($params)->count() !== $count) {
            throw new \Exception('Beatmapset count in index does not match test setup.');
        }
    }

    public static function tearDownAfterClass(): void
    {
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

    #[DataProvider('dataProvider')]
    public function testSearch(array $params, array $expected): void
    {
        $this->assertEqualsCanonicalizing(
            array_map(fn (int $index) => static::$beatmapsets[$index]->getKey(), $expected),
            new BeatmapsetSearch(new BeatmapsetSearchRequestParams($params))->response()->ids()
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        config_set('osu.beatmapset.guest_advanced_search', true);
    }
}
