<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Store;

use App\Exceptions\InvariantException;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class OrderExtraData implements Castable
{
    private ?string $countryAcronym;
    private ?Product $product;
    private ?int $duration;
    private ?int $targetId;
    private ?int $tournamentId;
    private ?string $username;

    public function __construct(array $data)
    {
        $this->product = $data['product'] ?? null;

        // supproter tag
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
                    throw new InvariantException('OrderExtraData model must be OrderItem');
                }

                $dataJson = json_decode($value, true);
                $dataJson['product'] = $model->product;

                return new OrderExtraData($dataJson);
            }

            public function set($model, $key, $value, $attributes)
            {
                if (!($value instanceof OrderExtraData)) {
                    $value = new OrderExtraData($value);
                }

                return [$key => json_encode($value)];
            }
        };
    }

    public function getProduct()
    {
        return $this->product;
    }
}
