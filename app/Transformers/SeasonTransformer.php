<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Season;

class SeasonTransformer extends TransformerAbstract
{
    public function transform(Season $season): array
    {
        return [
            'end_date' => $season->endDate(),
            'id' => $season->getKey(),
            'name' => $season->name,
            'room_count' => $season->rooms()->count(),
            'start_date' => $season->startDate(),
        ];
    }
}
