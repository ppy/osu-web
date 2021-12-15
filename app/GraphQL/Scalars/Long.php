<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Scalars;

use GraphQL\Type\Definition\StringType;

class Long extends StringType
{
    public $name = 'Long';
    public $description = 'The `Long` scalar represents a signed 64-bit integer, serialized as a string.';
}
