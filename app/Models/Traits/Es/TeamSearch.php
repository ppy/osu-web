<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits\Es;

use App\Libraries\BBCodeForDB;
use App\Libraries\BBCodeFromDB;

trait TeamSearch
{
    use BaseDbIndexable;

    public static function esIndexingQuery()
    {
        return static::query();
    }

    public function toEsJson()
    {
        $document = [];
        foreach (static::esMappings() as $field => $mapping) {
            $document[$field] = match ($field) {
                'description' => BBCodeFromDB::removeBBCodeTags(new BBCodeForDB($this->description ?? '')->generate()),
                default => $this->$field,
            };
        }

        return $document;
    }
}
