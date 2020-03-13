<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

use App\Libraries\ValidationErrors;
use Exception;

class ValidationException extends Exception
{
    private $errors;

    public function __construct(ValidationErrors $errors = null, Exception $previous = null)
    {
        $message = null;
        if ($errors !== null) {
            $message = $errors->toSentence();
        }

        parent::__construct($message, 0, $previous);
        $this->errors = $errors;
    }

    public function getValidationErrors()
    {
        return $this->errors;
    }
}
