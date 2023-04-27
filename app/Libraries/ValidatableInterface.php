<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

interface ValidatableInterface
{
    const MAX_FIELD_LENGTHS = [];

    public function validationErrorsKeyBase(): string;
    public function validationErrors(): ValidationErrors;
    public function validateDbFieldLength(int $limit, string $dbField, ?string $checkField = null): void;
    public function validateDbFieldLengths(): void;
    public function validateFieldLength(int $limit, string $field, ?string $checkField = null): void;
}
