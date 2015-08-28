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

use Illuminate\Database\Eloquent\Model;

// temporary class until simpler acl is implemented
class Authorize extends Model {
	// taken from current forums
	private static $groups = [
		"default" => 2,
	];
	private static $options = [
		// acl_options where auth_option = 'f_post'
		"post" => 17,
	];

	private static $roles = [
		// acl_roles_data where auth_option_id = 17
		"canPost" => [14, 21],
	];

	protected $table = "phpbb_acl_groups";
	protected $casts = [
		"auth_option_id" => "integer",
		"auth_role_id" => "integer",
		"auth_setting" => "integer",
	];

	public static function canPost($user, $forum, $topic) {
		if (!$forum->canHavePost()) { return false; }

		if ($user === null) { return false; }

		if ($user->isAdmin()) { return true; }

		if ($user->isRestricted()) { return false; }

		if ($user->isSilenced()) { return false; }

		if (!$forum->canBeViewedBy($user)) { return false; }

		if ($topic !== null && $topic->isLocked()) { return false; }

		$permissions = static::where("group_id", static::$groups["default"])
			->where("forum_id", $forum->forum_id)
			->get();

		foreach ($permissions as $permission) {
			if ($permission->auth_setting === 1 && $permission->auth_option_id === static::$options["post"]) {
				return true;
			} elseif (in_array($permission->auth_role_id, static::$roles["canPost"], true)) {
				return true;
			}
		}

		return false;
	}
}
