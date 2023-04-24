<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\LegacyIrcKey;

class LegacyIrcKeyTransformer extends TransformerAbstract
{
    public function transform(LegacyIrcKey $key): array
    {
        return [
            'token' => $key->token,
        ];
    }
}
