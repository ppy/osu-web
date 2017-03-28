<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->defineAs(App\Models\Store\Product::class, 'master_tshirt', function (Faker\Generator $faker) {
    return  [
        'name' => 'osu! t-shirt (triangles) / '.$faker->colorName,
        'cost' => 16.00,
        'weight' => 100,
        'base_shipping' => 5.00,
        'next_shipping' => 4.00,
        'stock' => rand(1, 100),
        'max_quantity' => 5,
        'header_description' => '# osu! t-shirt swag',
        'promoted' => 1,
        'description' => "Brand new osu! t-shirts have arrived! Featuring a tasty triangle design by osu! designer flyte, it's a welcome addition to any avid osu! player’s wardrobe.

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
",
        'header_image' => 'https://puu.sh/hzgoB/1142f14e8b.jpg',
        'images_json' => json_encode([
                ['https://puu.sh/hxpsp/d0b8704769.jpg', 'https://puu.sh/hxpsp/d0b8704769.jpg'],
                ['https://puu.sh/hxptO/71121e05e7.jpg', 'https://puu.sh/hxptO/71121e05e7.jpg'],
                ['https://puu.sh/hzfUF/1b9af4dbd1.jpg', 'https://puu.sh/hzfUF/1b9af4dbd1.jpg'],
            ]),
    ];
});

$factory->defineAs(App\Models\Store\Product::class, 'child_tshirt', function (Faker\Generator $faker) {
    return  [
        'name' => 'osu! t-shirt (triangles) / '.$faker->colorName,
        'cost' => 16.00,
        'weight' => 100,
        'base_shipping' => 5.00,
        'next_shipping' => 4.00,
        'stock' => rand(1, 100),
        'max_quantity' => 5,
    ];
});
