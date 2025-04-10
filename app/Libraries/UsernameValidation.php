<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\RankHighest;
use App\Models\User;
use App\Models\UserBadge;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;

class UsernameValidation
{
    public static function allowedName(string $username): bool
    {
        foreach (model_pluck(DB::table('phpbb_disallow'), 'disallow_username') as $check) {
            if (preg_match('#^'.str_replace('%', '.*?', preg_quote($check, '#')).'$#i', $username)) {
                return false;
            }
        }

        return true;
    }

    public static function validateAvailability(string $username): ValidationErrors
    {
        $errors = new ValidationErrors('user');

        if (($availableDate = User::checkWhenUsernameAvailable($username)) > Carbon::now()) {
            $remaining = Carbon::now()->diff($availableDate, false);

            if ($remaining->totalDays >= User::INACTIVE_DAYS) {
                //no need to mention the inactivity period of the account is actively in use.
                $errors->add('username', '.username_in_use');
            } elseif ($remaining->totalDays > 0) {
                $errors->add(
                    'username',
                    '.username_available_in',
                    ['duration' => osu_trans_choice('common.count.days', ((int) $remaining->totalDays) + 1)]
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

        if (!static::allowedName($username)) {
            $errors->add('username', '.username_not_allowed');
        }

        return $errors;
    }

    public static function validateUsersOfUsername(string $username): ValidationErrors
    {
        $errors = new ValidationErrors('user');
        $userIds = static::usersOfUsername($username)->pluck('user_id');

        // Check if any of the users have been ranked in the top 100
        $highestRank = RankHighest::whereIn('user_id', $userIds)->min('rank');
        if ($highestRank !== null && $highestRank <= 100) {
            return $errors->add('username', '.username_locked');
        }

        // Check if any of the users have badges
        if (UserBadge::whereIn('user_id', $userIds)->exists()) {
            return $errors->add('username', '.username_locked');
        }

        // Check if any of the users have beatmaps or beatmapsets with
        // leaderboards enabled
        if (
            Beatmap::scoreable()->whereIn('user_id', $userIds)->exists() ||
            Beatmapset::scoreable()->whereIn('user_id', $userIds)->exists()
        ) {
            return $errors->add('username', '.username_locked');
        }

        return $errors;
    }

    private static function usersOfUsername(string $username): Collection
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
