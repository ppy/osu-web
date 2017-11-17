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

        $errors = User::validateUsername($this->newUsername, $this->user->username);
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->validationErrors()->addTranslated('username', $error);
            }
        }

        return $this->validationErrors();
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
