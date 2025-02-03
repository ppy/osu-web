<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Tag;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $item)
    {
        return [
            'id' => $item->getKey(),
            'name' => $item->name,
            'description' => $item->description,
        ];
    }
}
