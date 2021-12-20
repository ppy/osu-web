<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $this->assertGetRoutes(['/wiki']);
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
        $user = User::factory()->create();

        $this->assertGetRoutes(["/u/{$user->getKey()}", "/u/{$user->username}"]);
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
