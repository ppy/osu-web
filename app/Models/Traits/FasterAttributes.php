<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits;

use Carbon\Carbon;

trait FasterAttributes
{
    /**
     * Fast Time Attribute to Json Transformer
     *
     * This is only usable for columns with default dateFormat (`Y-m-d H:i:s`)
     * or unix timestamp.
     */
    public function getJsonTime(string $key): ?string
    {
        $value = $this->getRawAttribute($key);

        if ($value === null) {
            return null;
        }

        if (is_int($value)) {
            return json_time(\DateTime::createFromTimestamp($value));
        }

        $isDatetimeColumn = $key === static::CREATED_AT
            || $key === static::UPDATED_AT
            || ($this->casts[$key] ?? '') === 'datetime';

        if (!$isDatetimeColumn) {
            throw new \TypeError("not a datetime column: '{$key}'");
        }

        $value[10] = 'T';

        return "{$value}Z";
    }

    public function getRawAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    protected function getArray(string $key, $associative = true): ?array
    {
        $value = $this->getRawAttribute($key);

        return $value === null ? null : json_decode($value, $associative);
    }

    protected function getNullableBool(string $key)
    {
        $raw = $this->getRawAttribute($key);

        return $raw === null ? null : (bool) $raw;
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
