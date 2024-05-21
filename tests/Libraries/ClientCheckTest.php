<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\ClientCheck;
use App\Models\Build;
use Tests\TestCase;

class ClientCheckTest extends TestCase
{
    public function testParseToken(): void
    {
        $build = Build::factory()->create(['allow_ranking' => true]);
        $request = \Request::instance();
        $request->headers->set('x-token', static::createClientToken($build));

        $parsed = ClientCheck::parseToken($request);

        $this->assertSame($build->getKey(), $parsed['buildId']);
        $this->assertNotNull($parsed['token']);
    }

    public function testParseTokenExpired()
    {
        $build = Build::factory()->create(['allow_ranking' => true]);
        $request = \Request::instance();
        $request->headers->set('x-token', static::createClientToken($build, 0));

        $parsed = ClientCheck::parseToken($request);

        $this->assertSame($build->getKey(), $parsed['buildId']);
        $this->assertNull($parsed['token']);
    }

    public function testParseTokenNonRankedBuild(): void
    {
        $build = Build::factory()->create(['allow_ranking' => false]);
        $request = \Request::instance();
        $request->headers->set('x-token', static::createClientToken($build));

        $parsed = ClientCheck::parseToken($request);

        $this->assertSame($GLOBALS['cfg']['osu']['client']['default_build_id'], $parsed['buildId']);
        $this->assertNull($parsed['token']);
    }
}
