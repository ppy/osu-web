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
use Hash;

class UserRegistration
{
    use Validatable;

    private $user;
    private $validated = false;

    public function __construct()
    {
        $this->user = new User();
    }

    public function fill($params)
    {
        $this->params = $params;
        $this->validated = false;

        return $this;
    }

    public function isValid($revalidate = false)
    {
        if (!$this->validated || $revalidate) {
            $usernameValidationErrors = User::validateUsername($this->params['username']);
            if (count($usernameValidationErrors) !== 0) {
                foreach ($usernameValidationErrors as $error) {
                    $this->validationErrors()->addTranslated('username', $error);
                }
            }

            $userPassword = (new UserPassword($this->user, false))
                ->fill($this->params);

            if (!$userPassword->isValid()) {
                foreach ($userPassword->all() as $column => $messages) {
                    foreach ($messages as $message) {
                        $this->validationErrors()->addTranslated($column, $message);
                    }
                }
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save()
    {
        if (!$this->isValid()) {
            return false;
        }

        // return $this->user->updatePassword($this->params['password']);
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user_registration';
    }
}
