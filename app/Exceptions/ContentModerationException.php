<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

/**
 * Exception thrown on user-supplied input that fails to clear automated moderation checks.
 * It is generally fine to not provide any user-facing message to indicate that this is the case.
 */
class ContentModerationException extends InvariantException
{
}
