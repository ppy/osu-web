<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Docs\Attributes;

use Attribute;
use Knuckles\Scribe\Attributes\GenericParam;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Offset extends GenericParam
{
    public function __construct(
        string $description = 'Result offset for pagination.',
        bool $required = false,
        ?int $example = 1,
    ) {
        parent::__construct('offset', 'integer', $description, $required, $example ?? 'No-example');
    }
}

