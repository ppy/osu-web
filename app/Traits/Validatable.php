<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Traits;

use App\Libraries\ValidationErrors;

trait Validatable
{
    protected $_validationErrors = null;

    abstract public function validationErrorsTranslationPrefix();

    public function validationErrorsKeyBase()
    {
        return 'model_validation.';
    }

    public function validationErrors() : ValidationErrors
    {
        if ($this->_validationErrors === null) {
            $this->_validationErrors = new ValidationErrors(
                $this->validationErrorsTranslationPrefix(),
                $this->validationErrorsKeyBase()
            );
        }

        return $this->_validationErrors;
    }
}
