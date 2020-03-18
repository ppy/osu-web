<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Serializers;

class ApiSerializer extends \League\Fractal\Serializer\ArraySerializer
{
    /**
     * no 'data' root node thx.
     */
    public function collection($resourceKey, array $data)
    {
        return $data;
    }
}
