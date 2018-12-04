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

use App\Models\User;
use App\Traits\Validatable;

class ChangeUsername
{
    use Validatable;

    private $newUsername;
    private $type;

    /** @var User */
    private $user;

    public function __construct(User $user, $newUsername, $type)
    {
        $this->user = $user;
        $this->newUsername = $newUsername;
        $this->type = $type;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function validate()
    {
        $this->validationErrors()->reset();

        // FIXME: move username the same validation here.

        $errors = User::validateUsername($this->newUsername, $this->user->username);
        $this->validationErrors()->merge($errors);
        $this->validatePreviousUsers();

        return $this->validationErrors();
    }

    public function validatePreviousUsers()
    {
        $previousUsers = $this->previousUsers()->get();
        foreach ($previousUsers as $previousUser) {
            // has badges
            if ($previousUser->badges()->exists()) {
                $this->validationErrors()->add('username', '.has_badge');
            }

            // ranked beatmaps
            if ($previousUser->beatmapsets()->rankedOrApproved()->exists()) {
                $this->validationErrors()->add('username', '.ranked_beatmapets');
            }

            // ranks
        }

        return $this->validationErrors();
    }

    public function previousUsers()
    {
        return User::whereHas('usernameChangeHistory', function ($query) {
            $query->where('username_last', $this->newUsername);
        });
    }

    public function isValid()
    {
        return $this->validationErrors()->isEmpty();
    }

    // TODO: move User::changeUsername here.

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'change_username';
    }
}
