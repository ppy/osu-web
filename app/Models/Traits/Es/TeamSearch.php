<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits\Es;

use App\Libraries\BBCodeFromDB;

trait TeamSearch
{
    use BaseDbIndexable;

    public static function esIndexingQuery()
    {
        return static::query();
    }

    public function getEsFieldValue(string $field)
    {
        return match ($field) {
            'description' => BBCodeFromDB::removeBBCodeTags($this->description),
            default => $this->$field,
        };
    }
}
