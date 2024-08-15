<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Docs\Attributes;

use Attribute;
use Knuckles\Scribe\Attributes\GenericParam;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Limit extends GenericParam
{
    public function __construct(
        int $default = 20, // values are defaults on pagination()
        int $minimum = 5,
        int $maximum = 50,
        string $description = 'Maximum number of results',
        bool $required = false,
        string|int $example = 'No-example',
    ) {
        $description .= " (Default: {$default}, Minimum: {$minimum}, Maximum: {$maximum})";

        parent::__construct('limit', 'integer', $description, $required, $example);
    }
}
