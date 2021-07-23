<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Artist;
use Exception;
use Tests\TestCase;

class ModelTest extends TestCase
{
    public function testGetWithHasMore()
    {
        factory(Artist::class, 5)->create();
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
}
