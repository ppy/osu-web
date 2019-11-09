<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Exceptions;

use Exception;

class SilencedException extends Exception
{
    // This is used for exceptions we don't want reported to Sentry
}
