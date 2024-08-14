<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Docs\Strategies;

use App\Docs\Attributes\Limit;
use App\Docs\Attributes\Offset;
use App\Docs\Attributes\Page;
use App\Docs\Attributes\SortCustom;
use App\Docs\Attributes\SortId;
use Http\Message\Authentication\QueryParam;
use Knuckles\Scribe\Extracting\Strategies\GetParamsFromAttributeStrategy;

class GetFromQueryParamAttribute extends GetParamsFromAttributeStrategy
{
    protected static array $attributeNames = [
        Limit::class,
        Offset::class,
        Page::class,
        QueryParam::class,
        SortCustom::class,
        SortId::class,
    ];
}
