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

use Illuminate\Database\Eloquent\ModelNotFoundException;

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/lib',
	app_path().'/traits',

));


/*
|--------------------------------------------------------------------------
| Reponse::route() macro
|--------------------------------------------------------------------------
|
| Provides the ability to supply both AJAX and regular redirects at
| the same time. Will always generate relative Location headers,
| and will default to "home" ("/") if no route was found.
| IDs/params to pass to the URL can be passed in.
|
*/
Response::macro('route', function ($url, $ids = array(), $params = null)
{

	try {
		$url = URL::route($url, $ids, $absolute = false);
	} catch (Exception $e) {
		$url = URL::route("home", $absolute = false);
	}

	if ($params and is_array($params)) {
		$query = [];
		foreach ($params as $key => $value) {
			$query[] = $key . "=" . $value;
		}
		$url = $url . "?" . implode("&", $query);
	}

	if (Request::ajax() or Input::has("ajax"))
		return Response::json(["url" => $url]);
	else
		return Redirect::to($url);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return osu_error(503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
require app_path().'/start/osu.php';
require app_path().'/html_macros.php';
