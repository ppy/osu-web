<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Docs\Strategies;

use App\Docs\Attributes\Limit;
use Knuckles\Scribe\Extracting\Strategies\GetParamsFromAttributeStrategy;

class QueryParamLimit extends GetParamsFromAttributeStrategy
{
    protected static array $attributeNames = [Limit::class];
}
