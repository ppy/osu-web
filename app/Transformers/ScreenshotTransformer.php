<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Screenshot;

class ScreenshotTransformer extends TransformerAbstract
{
    public function transform(Screenshot $screenshot)
    {
        $dimensions = $screenshot->dimensions();

        return [
            'height' => $dimensions[1] ?? 0,
            'id' => $screenshot->getKey(),
            'url' => $screenshot->url(),
            'width' => $dimensions[0] ?? 0,
        ];
    }
}
