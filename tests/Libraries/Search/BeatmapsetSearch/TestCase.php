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
use PHPUnit\Framework\Attributes\AfterClass;
use PHPUnit\Framework\Attributes\BeforeClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected static iterable $beatmapsets = [];
    protected array $defaultExpectedSort = ['approved_date', 'id'];

    abstract public static function dataProvider(): array;

    /**
     * Should run before setUpBeforeClass.
     * This runs beforeClass as well, to workaround data that may be left in the index from other tests.
     * Due to Laravel not sending the transaction events when it wraps tests in a transaction,
     * afterCommit may or may not unintentionally index documents,
     * depending on whether or no additional transactions are involved in the test.
     */
    #[AfterClass, BeforeClass]
    public static function cleanupEsBeatmapsets(): void
    {
        new BeatmapsetSearch()->deleteAll();
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
    public function testSearch(array $params, array $expected, ?array $expectedSort = null): void
    {
        $actualExpectedSort = $expectedSort ?? $this->defaultExpectedSort;
        $expectedIds = array_map(fn (int $index) => (string) static::$beatmapsets[$index]->getKey(), $expected);
        $search = new BeatmapsetSearch(new BeatmapsetSearchRequestParams($params));

        $fields = array_map(fn ($sort) => $sort->field, $search->getParams()->sorts);
        $this->assertSame($actualExpectedSort, $fields);

        // don't test for order for relevancy ordering, see TitleFilterTest for more info.
        if ($actualExpectedSort[0] === '_score') {
            $this->assertEqualsCanonicalizing($expectedIds, $search->response()->ids());
        } else {
            $this->assertSame($expectedIds, $search->response()->ids());
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        config_set('osu.beatmapset.guest_advanced_search', true);
    }
}
