<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Store;

use ArrayAccess;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
use JsonSerializable;

class OrderItemExtraData implements Castable, JsonSerializable
{
    public ?string $countryAcronym;
    public ?Product $product;
    public ?int $duration;
    public ?int $targetId;
    public ?int $tournamentId;
    public ?string $username;

    public function __construct(array $data)
    {
        $this->product = $data['product'] ?? null;

        // supporter tag
        $this->duration = $data['duration'] ?? null;
        $this->targetId = $data['target_id'] ?? null;
        $this->username = $data['username'] ?? null;

        // tournament banner
        $this->tournamentId = $data['tournament_id'] ?? null;
        $this->countryAcronym = $data['cc'] ?? null;
    }

    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            public function get($model, $key, $value, $attributes)
            {
                if (!($model instanceof OrderItem)) {
                    throw new InvalidArgumentException('OrderItemExtraData model must be OrderItem');
                }
                \Log::debug('get', compact('key', 'value'));
                $dataJson = json_decode($value, true);
                $dataJson['product'] = $model->product;

                return new OrderItemExtraData($dataJson);
            }

            public function set($model, $key, $value, $attributes)
            {
                if (!($model instanceof OrderItem)) {
                    throw new InvalidArgumentException('OrderItemExtraData model must be OrderItem');
                }
                \Log::debug('set', compact('key', 'value'));
                if (!($value instanceof OrderItemExtraData)) {
                    $value = new OrderItemExtraData($value);
                }

                return [$key => json_encode($value)];
            }
        };
    }

    public function jsonSerialize(): ?array
    {
        $ret = [
            'cc' => $this->countryAcronym,
            'duration' => $this->duration,
            'target_id' => $this->targetId,
            'tournament_id' => $this->tournamentId,
            'username' => $this->username,
        ];

        foreach ($ret as $field => $value) {
            if ($value === null) {
                unset($ret[$field]);
            }
        }

        return $ret !== [] ? $ret : null;
    }
}
