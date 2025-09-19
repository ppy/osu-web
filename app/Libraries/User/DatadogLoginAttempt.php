<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

class DatadogLoginAttempt
{
    public static function log($failReasonOrNull)
    {
        $success = $failReasonOrNull === null;

        datadog_increment('login_attempts', [
            'success' => (int) $success,
            'reason' => $failReasonOrNull,
        ]);
    }
}
