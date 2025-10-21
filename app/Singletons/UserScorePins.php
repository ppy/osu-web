<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Solo;
use Ds\Set;

class UserScorePins
{
    const REQUEST_ATTRIBUTE_KEY = 'current_user_score_pins';

    public function isPinned(Solo\Score $score): bool
    {
        $pins = request_attribute_remember(
            static::REQUEST_ATTRIBUTE_KEY,
            fn () => new Set(\Auth::user()?->scorePins()->pluck('score_id') ?? []),
        );

        return $pins->contains($score->getKey());
    }

    public function reset(): void
    {
        \Request::instance()
            ->attributes
            ->remove(static::REQUEST_ATTRIBUTE_KEY);
    }
}
