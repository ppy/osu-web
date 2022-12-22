<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
use JsonSerializable;

abstract class ExtraDataBase implements Castable, JsonSerializable
{
    const TYPE = '';

    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            public function get($model, $key, $value, $attributes)
            {
                if (!($model instanceof OrderItem)) {
                    throw new InvalidArgumentException('model must be OrderItem');
                }

                $dataJson = json_decode($value ?? '', true) ?? [];

                return ExtraDataBase::toExtraDataClass($dataJson);
            }

            public function set($model, $key, $value, $attributes)
            {
                if (!($model instanceof OrderItem)) {
                    throw new InvalidArgumentException('model must be OrderItem');
                }

                if ($value !== null && !($value instanceof ExtraDataBase)) {
                    $value = ExtraDataBase::toExtraDataClass($value);
                }

                return [$key => $value !== null ? json_encode($value) : null];
            }
        };
    }

    public static function toExtraDataClass(array $data)
    {
        // avoid using data from the model, they might not be set when this is called.
        $type = $data['type'] ?? static::guessType($data);

        return match ($type) {
            ExtraDataSupporterTag::TYPE => new ExtraDataSupporterTag($data),
            ExtraDataTournamentBanner::TYPE => new ExtraDataTournamentBanner($data),
            default => null,
        };
    }

    private static function guessType(array $data)
    {
        if (isset($data['target_id']) && isset($data['duration'])) {
            return ExtraDataSupporterTag::TYPE;
        }

        // we know it's some kind of tournament...just not which one
        if (isset($data['tournament_id']) && isset($data['cc'])) {
            return ExtraDataTournamentBanner::TYPE;
        }

        return null;
    }

    public function jsonSerialize(): array
    {
        return ['type' => static::TYPE];
    }
}
