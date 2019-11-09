<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries;

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Models\User;
use App\Models\UserGroup;
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

                $groupAttrs = ['group_id' => UserGroup::GROUPS['default']];
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
