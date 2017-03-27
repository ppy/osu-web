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

namespace App\Models;

use App\Traits\Validatable;
use Hash;

class UserPassword
{
    use Validatable;

    private $user;
    private $validated = false;

    public function __construct($user)
    {
        $this->user = $user;
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
            $this->validated = true;
            $this->validationErrors()->reset();

            foreach (['current_password', 'password', 'password_confirmation'] as $param) {
                if (!present($this->params[$param] ?? null)) {
                    $this->validationErrors()->add($param, 'required');
                }
            }

            if (!Hash::check($this->params['current_password'], $this->user->user_password)) {
                $this->validationErrors()->add('current_password', '.wrong_current_password');
            }

            if (strpos(strtolower($this->params['password']), strtolower($this->user->username)) !== false) {
                $this->validationErrors()->add('password', '.contains_username');
            }

            if (strlen($this->params['password']) < 8) {
                $this->validationErrors()->add('password', '.too_short');
            }

            if (WeakPassword::check($this->params['password']) === true) {
                $this->validationErrors()->add('password', '.weak');
            }

            if ($this->params['password'] !== $this->params['password_confirmation']) {
                $this->validationErrors()->add('password_confirmation', '.wrong_confirmation');
            }
        }

        return $this->validationErrors()->isAny();
    }

    public function save()
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->user->updatePassword($this->params['password']);
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user_password';
    }
}
