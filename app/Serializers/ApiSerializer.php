<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class ApiSerializer extends ArraySerializer
{
    /**
     * no 'data' root node thx.
     */
    public function collection(?string $resourceKey, array $data): array
    {
        return $data;
    }
}
