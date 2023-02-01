<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Season;

class SeasonTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'end_date',
        'start_date',
    ];

    public function transform(Season $season): array
    {
        return [
            'id' => $season->getKey(),
            'name' => $season->name,
            'room_count' => $season->rooms()->count(),
        ];
    }

    public function includeEndDate(Season $season) {
        return $this->primitive($season->endDate());
    }

    public function includeStartDate(Season $season) {
        return $this->primitive($season->startDate());
    }
}
