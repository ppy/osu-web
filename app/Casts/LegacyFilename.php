<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class LegacyFilename implements CastsAttributes
{
    public static function makeFromAttributes(?array $attributes): ?string
    {
        if (!isset($attributes['hash'])) {
            return null;
        }

        $filename = $attributes['hash'];
        if (isset($attributes['ext'])) {
            $filename .= ".{$attributes['ext']}";
        }

        return $filename;
    }

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return static::makeFromAttributes($attributes);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return [
            'ext' => null,
            'hash' => $value,
        ];
    }
}
