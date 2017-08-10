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
use Illuminate\Database\QueryException;

class UserEmail
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

            foreach (['current_password', 'email', 'email_confirmation'] as $param) {
                if (!present($this->params[$param] ?? null)) {
                    $this->validationErrors()->add($param, 'required');
                }
            }

            if (!Hash::check($this->params['current_password'], $this->user->user_password)) {
                $this->validationErrors()->add('current_password', '.wrong_current_password');
            }

            if (strpos($this->params['email'], '@') === false) {
                $this->validationErrors()->add('email', '.invalid');
            }

            if ($this->params['email'] !== $this->params['email_confirmation']) {
                $this->validationErrors()->add('email_confirmation', '.wrong_confirmation');
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save()
    {
        if (!$this->isValid()) {
            return false;
        }

        try {
            return $this->user->update(['user_email' => $this->params['email']]);
        } catch (QueryException $e) {
            $this->validationErrors()->add('email', '.already_used');

            return false;
        }
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user_email';
    }
}
