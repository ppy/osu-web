<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Country;
use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Models\Spotlight;

class SelectOptionTransformer extends TransformerAbstract
{
    public function transform(Country|Room|Season|Spotlight $item): array
    {
        return [
            'id' => $item->getKey(),
            'text' => $item->name,
        ];
    }
}
