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

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Models\User;
use Carbon\Carbon;
use Datadog;
use Exception;

class UserRegistration
{
    private $user;

    public function __construct($params)
    {
        $this->user = new User(array_merge([
            'user_permissions' => '',
            'user_interests' => '',
            'user_occ' => '',
            'user_sig' => '',
            'user_regdate' => Carbon::now(),
            'user_lastvisit' => Carbon::now(),
        ], $params));
    }

    public function assertValid()
    {
        if (!$this->validateAttributes()) {
            throw new ValidationException($this->user()->validationErrors());
        }

        $this->assertValidation(UsernameValidation::validateUsername($this->user->username));
        $this->assertValidation(UsernameValidation::validateAvailability($this->user->username));
        $this->assertValidation(UsernameValidation::validateUsersOfUsername($this->user->username));

        if (!$this->user->isValid()) {
            throw new ValidationException($this->user()->validationErrors());
        }
    }

    public function save()
    {
        $this->assertValid();

        try {
            $this->user->getConnection()->transaction(function () {
                User::findAndRenameUserForInactive($this->user->username);
                if (!$this->user->save()) {
                    // probably failed because of validation
                    throw new ValidationException($this->user->validationErrors());
                }

                $groupAttrs = ['group_id' => app('groups')->byIdentifier('default')->getKey()];
                if (!$this->user->userGroups()->create($groupAttrs)) {
                    // mystery failure
                    throw new ModelNotSavedException('failed saving model');
                }

                Datadog::increment('osu.new_account_registrations', 1, ['source' => 'osu-web']);
            });
        } catch (Exception $e) {
            if (is_sql_unique_exception($e)) {
                $this->user->validationErrors()->add('username', '.unknown_duplicate');
                throw new ValidationException($this->user->validationErrors(), $e);
            }

            throw $e;
        }
    }

    public function user()
    {
        return $this->user;
    }

    private function assertValidation($errors)
    {
        $this->user()->validationErrors()->merge($errors);

        if ($this->user()->validationErrors()->isAny()) {
            throw new ValidationException($this->user->validationErrors());
        }
    }

    private function validateAttributes()
    {
        $isValid = true;

        foreach (['username', 'user_email', 'password'] as $attribute) {
            if (!present($this->user->$attribute)) {
                $this->user->validationErrors()->add($attribute, 'required');
                $isValid = false;
            }
        }

        return $isValid;
    }
}
