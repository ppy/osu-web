<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Libraries;

use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;

class UsernameValidation
{
    public static function validateAvailability(string $username): ValidationErrors
    {
        $errors = new ValidationErrors('user');

        if (($availableDate = User::checkWhenUsernameAvailable($username)) > Carbon::now()) {
            $remaining = Carbon::now()->diff($availableDate, false);

            // the times are +1 to round up the interval; e.g. 5 days, 2 hours will show 6 days
            if ($remaining->days + 1 >= User::INACTIVE_DAYS) {
                //no need to mention the inactivity period of the account is actively in use.
                $errors->add('username', '.username_in_use');
            } elseif ($remaining->days > 0) {
                $errors->add(
                    'username',
                    '.username_available_in',
                    ['duration' => trans_choice('common.count.days', $remaining->days + 1)]
                );
            } elseif ($remaining->h > 0) {
                $errors->add(
                    'username',
                    '.username_available_in',
                    ['duration' => trans_choice('common.count.hours', $remaining->h + 1)]
                );
            } else {
                $errors->add('username', '.username_available_soon');
            }
        }

        return $errors;
    }

    public static function validateUsername($username)
    {
        $errors = new ValidationErrors('user');

        if (($username ?? '') !== trim($username)) {
            $errors->add('username', '.username_no_spaces');
        }

        if (strlen($username) < 3) {
            $errors->add('username', '.username_too_short');
        }

        if (strlen($username) > 15) {
            $errors->add('username', '.username_too_long');
        }

        if (strpos($username, '  ') !== false || !preg_match('#^[A-Za-z0-9-\[\]_ ]+$#u', $username)) {
            $errors->add('username', '.username_invalid_characters');
        }

        if (strpos($username, '_') !== false && strpos($username, ' ') !== false) {
            $errors->add('username', '.username_no_space_userscore_mix');
        }

        foreach (model_pluck(DB::table('phpbb_disallow'), 'disallow_username') as $check) {
            if (preg_match('#^'.str_replace('%', '.*?', preg_quote($check, '#')).'$#i', $username)) {
                $errors->add('username', '.username_not_allowed');
                break;
            }
        }

        return $errors;
    }

    public static function validateUsersOfUsername(string $username): ValidationErrors
    {
        $errors = new ValidationErrors('user');

        $users = static::usersOfUsername($username);
        foreach ($users as $user) {
            // has badges
            if ($user->badges()->exists()) {
                return $errors->add('username', '.username_locked');
            }

            // ranked beatmaps
            if ($user->beatmapsets()->rankedOrApproved()->exists()) {
                return $errors->add('username', '.username_locked');
            }
        }

        return $errors;
    }

    public static function usersOfUsername(string $username): Collection
    {
        $userIds = UsernameChangeHistory::where('username_last', $username)->pluck('user_id');
        $users = User::whereIn('user_id', $userIds)->get();
        $existing = User::findByUsernameForInactive($username);
        if ($existing !== null) {
            $users->push($existing);
        }

        return $users;
    }
}
