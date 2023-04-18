<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\ApiKey;

class LegacyApiKeyTransformer extends TransformerAbstract
{
    public function transform(ApiKey $legacyApi): array
    {
        return [
            'api_key' => $legacyApi->api_key,
            'app_name' => $legacyApi->app_name,
            'app_url' => $legacyApi->app_url,
        ];
    }
}
