<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Docs\Attributes;

use Attribute;
use Knuckles\Scribe\Attributes\GenericParam;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class SortCustom extends GenericParam
{
    public function __construct(
        array|string $sorts,
        ?string $defaultText = null,
        ?string $example = null,
    ) {
        if (is_string($sorts)) {
            $hash = mb_strtolower($sorts);
            $description = "Sort option as defined in [{$sorts}](#{$hash}).";
        } else {
            $description = 'Sort order; '.implode(', ', array_map(fn ($sort) => "`{$sort}`", $sorts));
        }

        if ($defaultText !== null) {
            $description .= " {$defaultText}";
        }

        parent::__construct('sort', 'string', $description, false, $example ?? 'No-example');
    }
}

