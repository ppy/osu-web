<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Search;

use App\Exceptions\InvariantException;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetSearchRequestParamsTest extends TestCase
{
    /**
     * @dataProvider cursorsDataProvider
     */
    public function testCursors(?string $sort, ?array $cursor, bool $throws, ?array $expected)
    {
        $requestParams = [];
        if ($sort !== null) {
            $requestParams['sort'] = $sort;
        }

        if ($cursor !== null) {
            $requestParams['cursor'] = $cursor;
        }

        if ($throws) {
            $this->expectException(InvariantException::class);
        }

        $user = factory(User::class)->create();
        $searchAfter = (new BeatmapsetSearchRequestParams($requestParams, $user))->searchAfter;

        $this->assertSame($expected, $searchAfter);
    }

    /**
     * @dataProvider cursorsGuestDataProvider
     */
    public function testCursorsGuest(?string $sort, ?array $cursor, bool $throws, ?array $expected)
    {
        $requestParams = [];
        if ($sort !== null) {
            $requestParams['sort'] = $sort;
        }

        if ($cursor !== null) {
            $requestParams['cursor'] = $cursor;
        }

        if ($throws) {
            $this->expectException(InvariantException::class);
        }

        $searchAfter = (new BeatmapsetSearchRequestParams($requestParams))->searchAfter;

        $this->assertSame($expected, $searchAfter);
    }

    public function cursorsDataProvider()
    {
        return [
            [null, null, false, null],
            ['', null, false, null],
            [null, [], true, null],
            ['', [], true, null],
            ['title_desc', null, false, null],
            ['title_desc', ['title.raw' => 'a'], true, null],
            ['title_desc', ['title.raw' => 'a', '_id' => 1], false, ['a', 1]],
            ['title_desc', ['_id' => 1, 'title.raw' => 'a'], false, ['a', 1]],
            ['title_desc', ['ignored' => 'hi', 'title.raw' => 'a', '_id' => 1], false, ['a', 1]],
        ];
    }

    public function cursorsGuestDataProvider()
    {
        return [
            [null, null, false, null],
            ['', null, false, null],
            [null, [], true, null],
            ['', [], true, null],
            ['title_desc', null, false, null],
            ['title_desc', ['title.raw' => 'a'], true, null],
            ['title_desc', ['title.raw' => 'a', '_id' => 1], true, null],
            ['title_desc', ['_id' => 1, 'title.raw' => 'a'], true, null],
            ['title_desc', ['ignored' => 'hi', 'title.raw' => 'a', '_id' => 1], true, null],
        ];
    }
}
