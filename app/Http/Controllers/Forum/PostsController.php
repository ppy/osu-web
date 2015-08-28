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

 namespace App\Http\Controllers\Forum;

use App\Libraries\BBCodeFromDB;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;

use Auth;
use Request;

class PostsController extends Controller {
	protected $section = "community";

	public function __construct() {
		$this->middleware("auth", ["only" => [
			"destroy",
			"raw",
		]]);

		return parent::__construct();
	}

	public function destroy($id) {
		$post = Post::findOrFail($id);

		$this->authorizePost($post->forum, $post->topic);
		if (!$post->canBeDeletedBy(Auth::user())) {
			abort(403);
		}

		$deletedPostPosition = $post->topic->postPosition($post->post_id);

		$post->topic->removePost($post);

		$topic = Topic::find($post->topic_id);

		if ($topic === null) {
			$redirect = route("forum.forums.show", $post->forum);
			return ujs_redirect($redirect);
		}

		return [
			"postId" => $post->post_id,
			"postPosition" => $deletedPostPosition,
		];
	}

	public function edit($id) {
		$post = Post::findOrFail($id);

		$this->authorizePost($post->forum, $post->topic);
		if (!$post->canBeEditedBy(Auth::user())) {
			abort(403);
		}

		return view("forum.topics._post_edit", compact("post"));
	}

	public function update($id) {
		$post = Post::findOrFail($id);

		$this->authorizePost($post->forum, $post->topic);
		if (!$post->canBeEditedBy(Auth::user())) {
			abort(403);
		}

		$body = Request::input("body");
		if ($body !== "") {
			$post->edit($body, Auth::user());
		}

		$posts = collect([$post->fresh()]);
		$topic = $post->topic;
		$postsPosition = $topic->postsPosition($posts);

		return view("forum.topics._posts", compact("posts", "postsPosition", "topic"));
	}

	public function raw($id) {
		$post = Post::findOrFail($id);

		$this->authorizeView($post->forum);

		$text = $post->bodyRaw;

		if (Request::input("quote") === "1") {
			$text = sprintf('[quote="%s"]%s[/quote]', $post->userNormalized()->username, $text);
		}

		return $text;
	}

	public function show($id) {
		$post = Post::findOrFail($id);

		$this->authorizeView($post->forum);

		return ujs_redirect(post_url($post->topic_id, $post->post_id));
	}
}
