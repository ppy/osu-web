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

 namespace App\Http\Controllers;

class APIController extends Controller {
	
	use \App\Traits\ModdingAPI;
	use \App\Traits\BeatmapAPI;

	public function __construct() {
		//$this->beforeFilter("auth");
		$this->beforeFilter("csrf.api", ['on' => ['get', 'post', 'put', 'delete']]);
	}

	/**
	 * GET /api/$version/translation/$lang?/$string 
	 *
	 * @api
	 * @return json
	 */
	public function getTranslation($lang, $string = null) {

		if (!$string) {
			$string = $lang;
			$lang = "en";
		}

		try {
			App::setLocale($lang);
		} catch (Exception $e) {
			return Response::json(["error" => "unsupported language"]);
		}

		if (strpos($string, " ")) {
			// dealing with an array
			$strings = explode(" ", $string);
			$translation = [];

			foreach ($strings as $str)
				$translation[$str] = Lang::get($str);

		} else {
			// single strings allow for fallback to english.
			// multiples would involve too much 
			$translation = Lang::get($string);

			if ($translation == $string and $lang != "en") {
				App::setLocale(Config::get("app.locale", "en"));
				$translation = Lang::get($string);
			}
		}

		return Response::json(["translation" => $translation]);

	}

	/**
	 * Get the user who initiated an action
	 *
	 * @return User
	 */
	protected function user() {
		return User::findByKey(Input::get("key")) ?: Auth::user();
	}

	/**
	 * Get the error view for the code given.
	 *
	 * @return View
	 */
	public function getError($code = 404) {
		return osu_error($code);
	}

	/**
	 * DRYing up code a bit.
	 *
	 * @return json
	 */
	public function error($key, $namespace) {
		return Response::json(["error" => Lang::get("$namespace.errors.$key")]);
	}

	/**
	 * GET /api/$version/
	 *
	 * @api
	 * @return json
	 */
	public function getIndex() {
		return Response::json(["error" => "throw new NotImplementedError();"]);
	}

	/**
	 * 404 method.
	 *
	 * @api
	 * @return json
	 */
	public function missingMethod($parameters = []) {
		return Response::json(["error" => 404]);
	}

	public function getFetchUserKey($username, $password, $hmac) {
		// all bancho input should be HMAC'd to be sure it's coming from bancho
		$check = hash_hmac("sha512", $username . $password, Config::get("osu.bancho.hmac"));

		if ($check !== $hmac) {
			// log HMAC failures
			sentry_log("HMAC failure for fetch-user-key", 403, Raven_Client::FATAL);

			return Response::json(["error" => 400]);
		}

		if (Auth::check() and Auth::user()->user_id === User::SYSTEM) {
			$user = User::where("username", "=", $username)->get();

			if ($user) {
				if ($key = $user->getBanchoKey()) {
					if (Auth::validate(["username" => $username, "password" => $password])) {
						return Response::json(["success" => $key]);
					} else {
						return Response::json(["error" => 403]);
					}
				} else {
					// If a user doesn;t have a key, they're banned
					return Response::json(["error" => 401]);
				}
			} else {
				// use status codes. they're easier for bancho
				// to understand and easier to deserialize
				return Response::json(["error" => 404]);
			}
		} else {
			// log bancho auth failures
			sentry_log("auth failure for fetch-user-key", 403, Raven_Client::FATAL);
		}
	}

	public function anyGitCallback() {
		if (Auth::check() and Auth::user()->user_id === User::GITHUB) {
			
			if (Input::get("ref") == "refs/heads/master") {
				Artisan::call("git:pull", ["--silent"]);
			}
			
		} else {
			sentry_log("user attempting to access git callback", "fatal", Raven_Client::FATAL);
			return Response::json(["error" => "no"]);
		}
	}
}
