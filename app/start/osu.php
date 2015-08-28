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

// osu!web~
// local functions for ease-of-use with templating.

function last_modified($path) {
	$mtime = Cache::tags("mtime")->get($path, false);

	if (!$mtime || Config::get('app.debug')) {
		$mtime = filemtime(public_path() . $path);
		Cache::tags("mtime")->put($path, $mtime, 5);
	}

	return $path . "?" . $mtime;
}

function format() {
    $args = func_get_args();

    $string = $args[0];
    unset($args[0]); // makes the next part easier

    foreach ($args as $key => $arg) {
        if (is_array($arg)) {
            $key = array_keys($arg)[0];
            $arg = $arg[$key];
        } elseif (is_int($key)) {
            $key = $key - 1;
        }

        $string = str_replace("{" . $key . "}", $arg, $string);
    }

    return $string;
}

function pending($a) {
	if (!$a["is_resolved"] && !$a["parent_item_id"] && !in_array($a["type"], ["nomination", "praise"])) {
		return true;
	}
	return false;
}

function resolved($a) {
	if ($a["is_resolved"] && !$a["parent_item_id"] && !in_array($a["type"], ["nomination", "praise"])) {
		return true;
	}
	return false;
}

function mod_total($a) {
	if (!$a["parent_item_id"] && !in_array($a["type"], ["nomination", "praise"])) {
		return true;
	}
	return false;
}

function modding_link($text) {
	$text = htmlspecialchars($text);
	$text = preg_replace('/(\d\d:\d\d:\d\d\d(?: \([0-9,#&;\|]+\))*)/i', '<code><a href="osu://edit/$1" class="osu-modtime">$1</a></code>', $text);

	return $text;
}

function linkify($text) {
	// javascript-friendly version: /(https?:\/\/(?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?)/i
	// note: parentheses have been removed from this.

	$regex = '(?P<paren>\([^)]*)?' . // possible parentheses outside
		'(?P<link>' .
			'https?' . // protocol
			':\/\/' .
			'(?P<domain>' .
				'(?:' .
					'[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.' . // domain
				')*' .
				'[a-z][a-z0-9-]*[a-z0-9]' . // tld
				'(?::\d+)' . // port
			'?)' .
			'(?P<path>' .
				'(?:' .
					'(?:\/+' .
						'(?:[a-z0-9$_\.\+!\*\',;:\(\)@&=-]|%[0-9a-f]{2})*' . // path
					')*' .
					'(?:' .
						'\?' .
						'(?:[a-z0-9$_\.\+!\*\',;:\(\)@&=-]|%[0-9a-f]{2})*' . // query string
					')?' .
				')?' .
				'(?:' .
					'#(?:[a-z0-9$_\.\+!\*\',;:\(\)@&=-]|%[0-9a-f]{2})*' . // fragment
				')?' .
			')?' .
		')';

	/*
		As the above regex splits up the URL to something that can be parsed,
		We can probably do logging in here and stick a spamfilter in this section.

	 */

	return preg_replace_callback("/" . $regex . "/i",
		function($matches) {
			if ($matches["paren"]) {
				$end = "";
				if (substr($matches["link"], -1) == ")") {
					$matches["link"] = substr($matches["link"], 0, -1);
					$end = ")";
				}


				return $matches["paren"] .
					'<a href="' . htmlspecialchars($matches["link"]) . '" rel="nofollow" target="_blank">' .
					htmlentities($matches["link"]) .
				'</a>' . $end;
			}

			return '<a href="' . htmlspecialchars($matches["link"]) . '" rel="nofollow" target="_blank">' . htmlentities($matches["link"]) . '</a>';
		},
	$text);
}

function current_route() {
	if (!Route::current())
		return "home";

	return Route::current()->getUri();
}

