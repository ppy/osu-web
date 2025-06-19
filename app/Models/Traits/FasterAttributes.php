<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits;

use Carbon\Carbon;

trait FasterAttributes
{
    public function getRawAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    protected function getArray(string $key): ?array
    {
        $value = $this->getRawAttribute($key);

        return $value === null ? null : json_decode($value, true);
    }

    protected function getNullableBool(string $key)
    {
        $raw = $this->getRawAttribute($key);

        return $raw === null ? null : (bool) $raw;
    }

    /**
     * Fast Time Attribute to Json Transformer
     *
     * Key must be suffixed with `_json`.
     * This is only usable for models with default dateFormat (`Y-m-d H:i:s`).
     */
    protected function getJsonTimeFast(string $key): ?string
    {
        $value = $this->getRawAttribute(substr($key, 0, -5));

        if ($value === null) {
            return null;
        }

        // From: "2020-10-10 10:10:10"
        // To: "2020-10-10T10:10:10Z"
        $value[10] = 'T';

        return "{$value}Z";
    }

    /**
     * Fast Time Attribute Getter (kind of)
     *
     * This is only usable for models with default dateFormat (`Y-m-d H:i:s`).
     */
    protected function getTimeFast(string $key): ?Carbon
    {
        return parse_db_time($this->getRawAttribute($key));
    }
}
