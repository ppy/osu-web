<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

class NotificationType
{
    const IGNORED = 'ignored';
    const PAYMENT = 'payment';
    const PENDING = 'pending';
    const REFUND = 'refund';
    const REJECTED = 'rejected';
    const USER_SEARCH = 'user_search';
}
