<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
use App\Models\User;

class RouteTest extends TestCase
{
    /**
     * Test the homepage (and aliases) don't error.
     *
     * @return void
     */
    public function testHomeRoutes()
    {
        $this->assertGetRoutes(['/', '/home/news']);
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
     * Test the support page doesn't error.
     *
     * @return void
     */
    public function testSupportRoutes()
    {
        $this->assertGetRoutes(['/help/support']);
    }

    /**
     * Test the ranking pages don't error.
     *
     * @return void
     */
    public function testRankingRoutes()
    {
        $this->assertGetRoutes(['/ranking/country', '/ranking/overall', '/ranking/charts', '/ranking/mapper']);
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
        $this->assertGetRoutes(["/u/{$id}", '/u/'.$username, "/community/profile/{$id}", 'community/profile/'.$username]);
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
}
