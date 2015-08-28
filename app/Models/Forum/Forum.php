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

 namespace App\Models\Forum;

use DB;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model {
	protected $table = "phpbb_forums";
	protected $primaryKey = "forum_id";
	protected $guarded = [];

	protected $dates = ["forum_last_post_time"];
	protected $dateFormat = "U";
	public $timestamps = false;

	public $lastTopic;

	protected $casts = [
		"enable_sigs" => "boolean",
		"forum_id" => "integer",
		"forum_last_post_id" => "integer",
		"forum_type" => "integer",
		"parent_id" => "integer",
	];

	public function categorySlug() {
		return "category-" . str_slug($this->category());
	}

	public function lastTopic($withSubforums = true) {
		if ($this->lastTopic === null) {
			$this->lastTopic = [Topic::whereIn("forum_id", $this->allSubforums())->orderBy("topic_last_post_time", "desc")->first()];
		}

		return $this->lastTopic[0];
	}

	public function allSubforums($forum_ids = null, $new_forum_ids = null) {
		if ($forum_ids === null) {
			$forum_ids = $new_forum_ids = [$this->forum_id];
		}
		$new_forum_ids = self::whereIn("parent_id", $new_forum_ids)->lists("forum_id")->all();

		$new_forum_ids = array_map(function($value) { return intval($value); }, $new_forum_ids);
		$forum_ids = array_merge($forum_ids, $new_forum_ids);

		if (count($new_forum_ids) === 0) {
			return $forum_ids;
		} else {
			return $this->allSubforums($forum_ids, $new_forum_ids);
		}
	}

	public function categoryId() {
		if ($this->forum_parents) {
			return array_keys($this->forum_parents)[0];
		} else {
			return $this->forum_id;
		}
	}

	public function category() {
		if ($this->forum_parents) {
			return array_values($this->forum_parents)[0][0];
		} else {
			return $this->forum_name;
		}
	}

	public function topics() {
		return $this->hasMany("App\Models\Forum\Topic", "forum_id", "forum_id");
	}

	public function parentForum() {
		return $this->belongsTo("App\Models\Forum\Forum", "parent_id", "forum_id");
	}

	public function subforums() {
		return $this->hasMany("App\Models\Forum\Forum", "parent_id", "forum_id")->orderBy("left_id");
	}

	public function getForumParentsAttribute($value) {
		$buf = unserialize($value);
		if (!$buf) {
			return [];
		} else { return $buf; }
	}

	public function canBeViewedBy($user) {
		if ($this->categoryId() !== config("osu.forum.admin_forum_id")) {
			return true;
		}
		return $user !== null && $user->isAdmin() === true;
	}

	public function canHavePost() {
		return $this->forum_type === 1;
	}

	public function refreshLastPostCache($post = null) {
		DB::transaction(function() use ($post) {
			if ($post === null) {
				$post = $this->lastTopic()->posts()->orderBy("post_id", "desc")->first();
			}

			if ($post === null) {
				$this->update([
					"forum_last_post_id" => null,
					"forum_last_poster_id" => null,
					"forum_last_post_subject" => null,
					"forum_last_post_time" => null,
					"forum_last_poster_name" => null,
					"forum_last_poster_colour" => null,
				]);
			} elseif ($this->forum_last_post_id !== $post->post_id) {
				$this->update([
					"forum_last_post_id" => $post->post_id,
					"forum_last_poster_id" => $post->user->user_id,
					"forum_last_post_subject" => $post->topic->topic_title,
					"forum_last_post_time" => $post->post_time,
					"forum_last_poster_name" => $post->user->username,
					"forum_last_poster_colour" => $post->user->user_colour,
				]);
			}
		});
	}
}
