<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Solo;

use App\Models\Solo\Score;
use App\Transformers\TransformerAbstract;

class ScoreTransformer extends TransformerAbstract
{
    public function transform(Score $score)
    {
        return array_merge((array) $score->data, [
            'id' => $score->getKey(),
        ]);
    }
}
