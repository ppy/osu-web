<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

class UserNotFound extends User
{
    public function checkPassword($password)
    {
        // password check should always fail.
        return false;
    }

    public function isValid()
    {
        return false;
    }

    public function save(array $options = [])
    {
        // not saveable.
        return false;
    }

    public static function instance()
    {
        static $user;
        if (!isset($user)) {
            $user = new static(['user_id' => -1, 'username' => osu_trans('supporter_tag.user_search.not_found')]);
        }

        return $user;
    }
}
