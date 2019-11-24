<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tests\Libraries\Search;

use App\Exceptions\InvariantException;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
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
}
