<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\UserCoverPreset;

class UserCoverPresetTransformer extends TransformerAbstract
{
    public function transform(UserCoverPreset $preset)
    {
        return [
            'active' => $preset->active,
            'id' => $preset->getKey(),
            'url' => $preset->file()->url(),
        ];
    }
}
