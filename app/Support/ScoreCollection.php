<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Support;

use App\Models\Count;

class ScoreCollection extends CollectionWithInjectedSelf
{
    private int $lastProcessedScoreId;

    public function lastProcessedScoreId(): int
    {
        return $this->lastProcessedScoreId ??= request_attribute_remember(
            'last_processed_score_id',
            fn (): int => Count::lastProcessedScoreId()->count,
        );
    }
}
