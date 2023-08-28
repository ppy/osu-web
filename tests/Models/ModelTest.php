<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Artist;
use App\Models\Country;
use Exception;
use Tests\TestCase;

class ModelTest extends TestCase
{
    /**
     * @dataProvider dataProviderForDecrementInstance
     */
    public function testDecrementInstance(callable $countryFn, bool $isChanged): void
    {
        $country = $countryFn();
        $anotherCountry = Country::factory()->create();
        $column = 'playcount';

        $this->expectCountChange(fn () => $country->$column, $isChanged ? -1 : 0);
        $this->expectCountChange(fn () => $anotherCountry->$column, 0);

        $country->decrementInstance($column);
        $country->refresh();
        $anotherCountry->refresh();
    }

    /**
     * @dataProvider dataProviderForDecrementInstance
     */
    public function testDecrementInstanceSpecifyCount(callable $countryFn, bool $isChanged): void
    {
        $country = $countryFn();
        $anotherCountry = Country::factory()->create();
        $column = 'playcount';
        $change = 10;

        $this->expectCountChange(fn () => $country->$column, $isChanged ? -$change : 0);
        $this->expectCountChange(fn () => $anotherCountry->$column, 0);

        $country->decrementInstance($column, $change);
        $country->refresh();
        $anotherCountry->refresh();
    }

    public function testGetWithHasMore()
    {
        Artist::factory()->count(5)->create();
        $count = Artist::count();

        $limit = $count - 1;
        [$artists, $hasMore] = Artist::select()->limit($limit)->getWithHasMore();

        $this->assertSame($limit, $artists->count());
        $this->assertTrue($hasMore);

        $offset = 2;
        $limit = $count - $offset - 1;
        [$artists, $hasMore] = Artist::select()->offset($offset)->limit($limit)->getWithHasMore();

        $this->assertSame($limit, $artists->count());
        $this->assertTrue($hasMore);

        $limit = $count;
        [$artists, $hasMore] = Artist::select()->limit($limit)->getWithHasMore();

        $this->assertSame($limit, $artists->count());
        $this->assertFalse($hasMore);

        $offset = 2;
        $limit = $count - $offset;
        [$artists, $hasMore] = Artist::select()->offset($offset)->limit($limit)->getWithHasMore();

        $this->assertSame($limit, $artists->count());
        $this->assertFalse($hasMore);

        $offset = 2;
        $limit = $count;
        [$artists, $hasMore] = Artist::select()->offset($offset)->limit($limit)->getWithHasMore();

        $this->assertSame($limit - $offset, $artists->count());
        $this->assertFalse($hasMore);
    }

    public function testGetWithHasMoreMissingLimit()
    {
        $this->expectException(Exception::class);

        Artist::select()->getWithHasMore();
    }

    /**
     * @dataProvider dataProviderForDecrementInstance
     */
    public function testIncrementInstance(callable $countryFn, bool $isChanged): void
    {
        $country = $countryFn();
        $anotherCountry = Country::factory()->create();
        $column = 'playcount';

        $this->expectCountChange(fn () => $country->playcount, $isChanged ? 1 : 0);
        $this->expectCountChange(fn () => $anotherCountry->$column, 0);

        $country->incrementInstance($column);
        $country->refresh();
        $anotherCountry->refresh();
    }

    /**
     * @dataProvider dataProviderForDecrementInstance
     */
    public function testIncrementInstanceSpecifyCount(callable $countryFn, bool $isChanged): void
    {
        $country = $countryFn();
        $anotherCountry = Country::factory()->create();
        $column = 'playcount';
        $change = 10;

        $this->expectCountChange(fn () => $country->$column, $isChanged ? $change : 0);
        $this->expectCountChange(fn () => $anotherCountry->$column, 0);

        $country->incrementInstance($column, $change);
        $country->refresh();
        $anotherCountry->refresh();
    }

    public function dataProviderForDecrementInstance(): array
    {
        return [
            [fn () => Country::factory()->create(), true],
            [fn () => new Country(['playcount' => 0]), false],
        ];
    }
}
