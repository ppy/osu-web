<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\User;

class UserSignatures
{
    private array $html = [];

    public function get(User $user): ?string
    {
        $userId = $user->getKey();

        if (!array_key_exists($userId, $this->html)) {
            $sig = $user->user_sig;

            $this->html[$userId] = present($sig)
                ? bbcode($user->user_sig, $user->user_sig_bbcode_uid)
                : null;
        }

        return $this->html[$userId];
    }
}
