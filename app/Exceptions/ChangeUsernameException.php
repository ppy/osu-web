<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

use App\Libraries\ValidationErrors;
use Exception;

class ChangeUsernameException extends Exception
{
    private $errors;

    public function __construct($errors, Exception $previous = null)
    {
        if ($errors instanceof ValidationErrors) {
            $message = $errors->toSentence();
            $this->errors = $errors;
        } else {
            $message = $errors;
        }

        parent::__construct($message, 0, $previous);
    }

    public function getErrors(): ValidationErrors
    {
        return $this->errors;
    }
}
