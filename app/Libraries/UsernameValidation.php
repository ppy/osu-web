<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
                    ['duration' => osu_trans_choice('common.count.days', $remaining->days + 1)]
                );
            } elseif ($remaining->h > 0) {
                $errors->add(
                    'username',
                    '.username_available_in',
                    ['duration' => osu_trans_choice('common.count.hours', $remaining->h + 1)]
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
            if ($user->profileBeatmapsetsRanked()->exists()) {
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
