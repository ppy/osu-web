<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

use Datadog;

class DatadogLoginAttempt
{
    public static function log($failReasonOrNull)
    {
        $success = $failReasonOrNull === null;

        Datadog::increment(config('datadog-helper.prefix_web').'.login_attempts', 1, [
            'success' => (int) $success,
            'reason' => $failReasonOrNull,
        ]);
    }
}
