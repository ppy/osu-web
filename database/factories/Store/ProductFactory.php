<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Store;

use App\Models\Store\Product;
use Database\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function childBanners(): static
    {
        return $this->state([
            'base_shipping' => 0.00,
            'cost' => 5.00,
            'custom_class' => 'mwc7-supporter',
            'display_order' => -10,
            'max_quantity' => 1,
            'next_shipping' => 0.00,
            'stock' => null,
            'weight' => null,
        ]);
    }

    public function childTshirt(): static
    {
        return $this->state([
            'base_shipping' => 5.00,
            'cost' => 16.00,
            'max_quantity' => 5,
            'name' => fn() => "osu! t-shirt (triangles) / {$this->faker->colorName}",
            'next_shipping' => 4.00,
            'stock' => rand(1, 100),
            'weight' => 100,
        ]);
    }

    public function definition(): array
    {
        return [
            'base_shipping' => 5.00,
            'cost' => 16.00,
            'max_quantity' => 1,
            'name' => fn() => "Imagination / {$this->faker->colorName}",
            'next_shipping' => 4.00,
            'stock' => rand(1, 100),
            'weight' => 100,
        ];
    }

    public function disabled(): static
    {
        return $this->state(['enabled' => false]);
    }

    public function masterTshirt(): static
    {
        return $this->state([
            'base_shipping' => 5.00,
            'cost' => 16.00,
            'description' => <<<EOF
Brand new osu! t-shirts have arrived! Featuring a tasty triangle design by osu! designer flyte, it's a welcome addition to any avid osu! player’s wardrobe.

* 100% cotton
* Medium weight, pre-shrunk
* Sizes: S, M, L, XL

```
Size             S    M    L    XL
Garment Length  66cm 70cm 74cm 78cm
Body width      49cm 52cm 55cm 58cm
Shoulder width  44cm 47cm 50cm 53cm
Sleeve length   19cm 20cm 22cm 24cm
```

NOTE: These are Japanese sizes. Overseas customers are advised to check the size chart above!
EOF,
            'header_description' => '# osu! t-shirt swag',
            'header_image' => 'https://puu.sh/hzgoB/1142f14e8b.jpg',
            'images_json' => json_encode([
                ['https://puu.sh/hxpsp/d0b8704769.jpg', 'https://puu.sh/hxpsp/d0b8704769.jpg'],
                ['https://puu.sh/hxptO/71121e05e7.jpg', 'https://puu.sh/hxptO/71121e05e7.jpg'],
                ['https://puu.sh/hzfUF/1b9af4dbd1.jpg', 'https://puu.sh/hzfUF/1b9af4dbd1.jpg'],
            ]),
            'max_quantity' => 5,
            'name' => fn() => "osu! t-shirt (triangles) / {$this->faker->colorName}",
            'next_shipping' => 4.00,
            'promoted' => 1,
            'stock' => rand(1, 100),
            'weight' => 100,
        ]);
    }
}
