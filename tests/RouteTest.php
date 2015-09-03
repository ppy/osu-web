<?php

/**
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/

class RouteTest extends TestCase {

	/**
	 * Test the homepage (and aliases) don't error.
	 *
	 * @return void
	 */
	public function testHomeRoutes()
	{
		$this->assertGetRoutes(["/", "/home/news"]);
	}

	/**
	 * Test the download page doesn't error.
	 *
	 * @return void
	 */
	public function testDownloadRoutes()
	{
		$this->assertGetRoutes(["/home/download"]);
	}

	/**
	 * Test the changelog page doesn't error.
	 *
	 * @return void
	 */
	public function testChangelogRoutes()
	{
		$this->assertGetRoutes(["/home/download"]);
	}

	/**
	 * Test the help page doesnt error
	 *
	 * @return void
	 */
	public function testWikiRoutes()
	{
		$this->assertGetRoutes(["/help/wiki"]);
	}

	/**
	 * Test the support page doesn't error.
	 *
	 * @return void
	 */
	public function testSupportRoutes()
	{
		$this->assertGetRoutes(["/help/support"]);
	}

	/**
	 * Test the changelog page doesn't error.
	 *
	 * @return void
	 */
	public function testBeatmapListingRoutes()
	{
		$this->assertGetRoutes(["/beatmaps/listing"]);
	}

	/**
	 * Test the beatmap modding pages doesn't error.
	 *
	 * @return void
	 */
	public function testBeatmapPageRoutes()
	{
		$this->assertGetRoutes(["/beatmaps/modding"]);
	}

	/**
	 * Test the profile page doesn't error.
	 *
	 * @return void
	 */
	public function testProfileRoutes()
	{
		$user = \App\Models\User::create([
			"username" => "testuser",
			"user_password" => password_hash(md5("testpassword"), PASSWORD_BCRYPT)
		]);
		$id = $user->user_id;
		$this->assertGetRoutes(["/u/{$id}", "/u/testuser", "/community/profile/{$id}", "community/profile/testuser"]);
	}

	/**
	 * Test the ranking pages don't error.
	 *
	 * @return void
	 */
	public function testRankingRoutes()
	{
		$this->assertGetRoutes(["/ranking/country", "/ranking/overall", "/ranking/charts", "/ranking/mapper"]);
	}

	/**
	 * Test the forums are sane (they aren't)
	 *
	 * @return void
	 */
	public function testForumRoutes()
	{
		$this->assertGetRoutes(["/forum", "/community/forum"]);
	}

	/**
	 * Test a given set of GET routes
	 *
	 * @return void
	 */
	protected function assertGetRoutes(array $routes = [])
	{
		$this->assertCustomRoute($routes, "GET");
	}

	/**
	 * Test the download page doesn't error.
	 *
	 * @return void
	 */
	protected function assertCustomRoute(array $routes, $method)
	{
		foreach ($routes as $route)
		{
			$response = $this->call($method, $route);
			$this->assertTrue($response->isOK() || $response->isRedirect());
		}
	}
}
