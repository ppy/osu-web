<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries\Payments;

use Exception;

// Specifically for xsolla's user_search and user_validation notifications
class XsollaUserNotFoundException extends Exception
{
}
