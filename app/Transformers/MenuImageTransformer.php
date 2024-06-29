<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

class MenuImageTransformer extends TransformerAbstract
{
    public function transform(array $menuImage): array
    {
        return [
            'ended_at' => json_time($menuImage['ended_at']),
            'image_url' => $menuImage['image_url'],
            'started_at' => json_time($menuImage['started_at']),
            'url' => $menuImage['url'],
        ];
    }
}
