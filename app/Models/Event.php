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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
	protected $table = "osu_events";
	protected $primaryKey = "event_id";

	protected $dates = ["date"];
	public $timestamps = false;

	protected $casts = [
		"event_id" => "integer",
		"beatmap_id" => "integer",
		"beatmapset_id" => "integer",
		"user_id" => "integer",
		"epicfactor" => "integer",
		"private" => "integer",
	];

	public function user()
	{
		return $this->belongsTo(User::class, "user_id", "user_id");
	}

	public function beatmap()
	{
		return $this->belongsTo(Beatmap::class, "beatmap_id", "beatmap_id");
	}

	public function beatmapSet()
	{
		return $this->belongsTo(BeatmapSet::class, "beatmapset_id", "beatmapset_id");
	}

	public function getEventDetailsAttribute()
	{
		return static::parseText($this->text);
	}

	public static function parseFailure($text)
	{
		\Log::info(json_encode([
			"tag" => "EVENT_PARSING_FAILURE",
			"text" => $text,
		]));
	}

	public static function parseText($text)
	{
		$event = [];
		if (preg_match("!<img src='/images/(?<scoreRank>.+?)_small\.png'/> <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> achieved (?:<b>)?rank #(?<rank>\d+?)(?:</b>)? on <a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> \((?<mode>.+?)\)$!", $text, $matches)) {
			$scoreRank = strtolower($matches["scoreRank"]);
			if ($scoreRank === "x") { $scoreRank = "ss"; }
			elseif ($scoreRank === "xh") { $scoreRank = "ssh"; }

			$beatmapUrl = "https://osu.ppy.sh".$matches["beatmapUrl"];

			switch($matches["mode"]) {
				case "osu!mania": $mode = "mania"; break;
				case "Taiko": $mode = "taiko"; break;
				case "osu!": $mode = "osu"; break;
				case "Catch the Beat": $mode = "ctb"; break;
				default: return static::parseFailure($text);
			}

			$event["type"] = "rank";
			$event["details"] = [
				"scoreRank" => $scoreRank,
				"mode" => $mode,
				"beatmap" => [
					"title" => $matches["beatmapTitle"],
					"url" => $beatmapUrl,
				],
				"user" => [
					"username" => $matches["userName"],
					"url" => $matches["userUrl"],
				],
			];
		} else {
			return static::parseFailure($text);
		}
		return $event;
	}
}
