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

namespace Tests;

use App\Models\Beatmap;
use App\Models\User;

class RouteTest extends TestCase
{
    /**
     * Test the homepage don't error.
     *
     * @return void
     */
    public function testHomeRoutes()
    {
        $this->assertGetRoutes(['/home']);
    }

    /**
     * Test the download page doesn't error.
     *
     * @return void
     */
    public function testDownloadRoutes()
    {
        $this->assertGetRoutes(['/home/download']);
    }

    /**
     * Test the changelog page doesn't error.
     *
     * @return void
     */
    public function testChangelogRoutes()
    {
        $this->assertGetRoutes(['/home/download']);
    }

    /**
     * Test the help page doesnt error.
     *
     * @return void
     */
    public function testWikiRoutes()
    {
        $this->assertGetRoutes(['/help/wiki']);
    }

    /**
     * Test the ranking pages don't error.
     *
     * @return void
     */
    public function testRankingRoutes()
    {
        $rankingTypes = ['performance', 'score', 'country'];

        foreach (Beatmap::MODES as $mode => $enum) {
            foreach ($rankingTypes as $type) {
                $this->assertGetRoutes(["/rankings/{$mode}/{$type}"]);
            }
        }
    }

    /**
     * Test the redirects for the ranking pages.
     *
     * @return void
     */
    public function testRankingRedirects()
    {
        foreach (Beatmap::MODES as $mode => $enum) {
            $this->assertRedirect(["/rankings/{$mode}"]);
        }

        $this->assertRedirect(['/rankings/']);
    }

    /**
     * Test the profile page doesn't error.
     *
     * @return void
     */
    public function testProfileRoutes()
    {
        $user = factory(User::class)->create();
        $id = $user->user_id;
        $username = $user->username;
        $this->assertGetRoutes(["/u/{$id}", '/u/'.$username]);
    }

    /**
     * Test a given set of GET routes.
     *
     * @return void
     */
    protected function assertGetRoutes(array $routes = [])
    {
        $this->assertCustomRoute($routes, 'GET');
    }

    /**
     * Test the download page doesn't error.
     *
     * @return void
     */
    protected function assertCustomRoute(array $routes, $method)
    {
        foreach ($routes as $route) {
            $response = $this->call($method, $route);
            $this->assertTrue($response->isOK() || $response->isRedirect());
        }
    }

    /**
     * Asserts that the given routes perform redirects.
     *
     * @return void
     */
    protected function assertRedirect(array $routes, $method = 'GET')
    {
        foreach ($routes as $route) {
            $response = $this->call($method, $route);
            $this->assertTrue($response->isRedirect());
        }
    }
}
