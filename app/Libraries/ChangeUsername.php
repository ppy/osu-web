<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\User;
use App\Traits\Validatable;

class ChangeUsername
{
    use Validatable;

    const LESS_VALIDATION_TYPES = ['admin', 'revert', 'support'];

    protected $type;

    protected $user;

    protected $username;

    public static function requireSupportedMessage()
    {
        $link = link_to(
            route('support-the-game'),
            osu_trans('model_validation.user.change_username.supporter_required.link_text')
        );

        return osu_trans('model_validation.user.change_username.supporter_required._', ['link' => $link]);
    }

    public function __construct(User $user, string $newUsername, string $type = 'paid')
    {
        $this->type = $type;
        $this->username = $newUsername;
        $this->user = $user;
    }

    public function validate(): ValidationErrors
    {
        $this->validationErrors()->reset();

        if ($this->user->user_id <= 1) {
            return $this->validationErrors()->addTranslated('user_id', 'This user cannot be renamed');
        }

        if ($this->hasExtraValidations() && $this->user->isRestricted()) {
            return $this->validationErrors()->add('username', '.change_username.restricted');
        }

        if ($this->hasExtraValidations() && !$this->user->hasSupported()) {
            return $this->validationErrors()->addTranslated('username', static::requireSupportedMessage());
        }

        // Block if new username is exactly the same as current (case-sensitive match)
        if (strcasecmp($this->username, $this->user->username) === 0 && $this->username === $this->user->username) {
            return $this->validationErrors()->add('username', '.change_username.username_is_same');
        }

        if ($this->validationErrors()->merge(UsernameValidation::validateUsername($this->username))->isAny()) {
            return $this->validationErrors();
        }

        if ($this->validationErrors()->merge(UsernameValidation::validateUsersOfUsername($this->username))->isAny()) {
            return $this->validationErrors();
        }

        return $this->validationErrors()->merge(UsernameValidation::validateAvailability($this->username));
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'user';
    }
    private function hasExtraValidations(): bool
    {
        if ($this->isCapitalizationOnlyChange()) {
            return false;
        }

        return !in_array($this->type, static::LESS_VALIDATION_TYPES, true);
    }
    private function isCapitalizationOnlyChange(): bool
    {
        return strcasecmp($this->username, $this->user->username) === 0
            && $this->username !== $this->user->username;
    }
}
