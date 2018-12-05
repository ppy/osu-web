<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Libraries\ValidationErrors;
use App\Models\User;
use App\Traits\Validatable;
use Carbon\Carbon;

class ChangeUsername
{
    use Validatable;

    private $newUsername;
    private $type;

    /** @var User */
    private $user;

    public static function requireSupportedMessage()
    {
        $link = link_to(
            route('support-the-game'),
            trans('model_validation.user.change_username.supporter_required.link_text')
        );

        return trans('model_validation.user.change_username.supporter_required._', ['link' => $link]);
    }

    public function __construct(User $user, string $newUsername, string $type)
    {
        $this->user = $user;
        $this->newUsername = $newUsername;
        $this->type = $type;
    }

    public function validate()
    {
        $this->validationErrors()->reset();

        $errors = new ValidationErrors('user');
        if (!$this->user->hasSupported()) {
            $this->validationErrors()->addTranslated('username', static::requireSupportedMessage());

            return $this->validationErrors();
        }

        if ($this->newUsername === $this->user->username) {
            $this->validationErrors()->add('username', '.change_username.username_is_same');

            return $this->validationErrors();
        }

        if ($this->validateUsername()->isAny()) {
            return $this->validationErrors();
        }

        if ($this->validatePreviousUsers()->isAny()) {
            return $this->validationErrors();
        }

        $this->validateAvailability();

        return $this->validationErrors();
    }

    public function validateAvailability() : ValidationErrors
    {
        if (($availableDate = User::checkWhenUsernameAvailable($this->newUsername)) > Carbon::now()) {
            $remaining = Carbon::now()->diff($availableDate, false);

            // the times are +1 to round up the interval; e.g. 5 days, 2 hours will show 6 days
            if ($remaining->days + 1 >= User::INACTIVE_DAYS) {
                //no need to mention the inactivity period of the account is actively in use.
                $this->validationErrors()->add('username', '.username_in_use');
            } elseif ($remaining->days > 0) {
                $this->validationErrors()->add(
                    'username',
                    '.username_available_in',
                    ['duration' => trans_choice('common.count.days', $remaining->days + 1)]
                );
            } elseif ($remaining->h > 0) {
                $this->validationErrors()->add(
                    'username',
                    '.username_available_in',
                    ['duration' => trans_choice('common.count.hours', $remaining->h + 1)]
                );
            } else {
                $this->validationErrors()->add('username', '.username_available_soon');
            }
        }

        return $this->validationErrors();
    }

    public function validateUsername()
    {
        $this->validationErrors()->merge(User::validateUsername($this->newUsername, $this->user->username));

        return $this->validationErrors();
    }

    public function validatePreviousUsers()
    {
        $previousUsers = $this->previousUsers()->get();
        foreach ($previousUsers as $previousUser) {
            // has badges
            if ($previousUser->badges()->exists()) {
                $this->validationErrors()->add('username', '.username_locked');
            }

            // ranked beatmaps
            if ($previousUser->beatmapsets()->rankedOrApproved()->exists()) {
                $this->validationErrors()->add('username', '.username_locked');
            }

            // ranks
        }

        return $this->validationErrors();
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user';
    }

    private function previousUsers()
    {
        return User::whereHas('usernameChangeHistory', function ($query) {
            $query->where('username_last', $this->newUsername);
        });
    }
}
