<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\BeatmapsetNomination;

class BeatmapsetNominationTransformer extends TransformerAbstract
{
    public function transform(BeatmapsetNomination $nomination)
    {
        return [
            'beatmapset_id' => $nomination->beatmapset_id,
            'rulesets' => $nomination->modes,
            'reset' => $nomination->reset,
            'user_id' => $nomination->user_id,
        ];
    }
}
