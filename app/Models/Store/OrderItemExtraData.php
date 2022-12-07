<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class OrderItemExtraData implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if (!($model instanceof OrderItem)) {
            throw new InvalidArgumentException('OrderItemExtraData model must be OrderItem');
        }

        \Log::debug('get', compact('key', 'value'));
        $dataJson = json_decode($value ?? '', true) ?? [];

        return ExtraDataBase::toExtraDataClass($dataJson);
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!($model instanceof OrderItem)) {
            throw new InvalidArgumentException('OrderItemExtraData model must be OrderItem');
        }

        \Log::debug('set', compact('key', 'value', 'attributes'));
        if ($value !== null && !($value instanceof ExtraDataBase)) {
            $value = ExtraDataBase::toExtraDataClass($value);
        }

        return [$key => $value !== null ? json_encode($value) : null];
    }
}
