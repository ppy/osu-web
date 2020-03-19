<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events\Fulfillments;

class UsernameReverted extends UsernameEvent
{
    public function toMessage()
    {
        return "`User {$this->user->user_id}` Reverted username to `{$this->user->username}`.";
    }
}
