<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\Country;
use App\Models\Store\Product;
use App\Models\Tournament;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedProducts();
        $this->seedBanners();
    }

    public function seedProducts()
    {
        $this->product_ids = [];
        $this->count = 0;

        $master_tshirt = factory(Product::class)->states('master_tshirt')->create();
        $child_shirts = factory(Product::class, 7)->states('child_tshirt')->create([
            'master_product_id' => $master_tshirt->product_id,
        ])->each(function ($s) {
            $this->product_ids[] = $s->product_id;
            $this->count++;
        });

        // Add the child shirt IDs to the master shirt's type_mappings_json
        $type_mappings_json = [];
        $sizes = ['S', 'M', 'L', 'XL'];

        $type_mappings_json[$master_tshirt->product_id] = [
            'size' => 'S',
            'colour' => 'White',
        ];

        $i = 1;
        foreach ($this->product_ids as $id) {
            if ($i < 4) {
                $colour = 'White';
            } else {
                $colour = 'Charcoal';
            }
            $type_mappings_json[$id] = [
                'size' => $sizes[$i % 4],
                'colour' => $colour,
            ];
            $i++;
        }
        $master_tshirt->type_mappings_json = json_encode($type_mappings_json, JSON_PRETTY_PRINT);
        $master_tshirt->save();
    }

    public function seedBanners()
    {
        $tournament = factory(Tournament::class)->create();
        // Get some countries to use.
        $countries = Country::limit(6)->get()->toArray();
        $master_country = array_shift($countries);

        $master = factory(Product::class)->states('child_banners')->create([
            'name' => "{$tournament->name} Support Banner ({$master_country['name']})",
            'description' => ':)',
            'header_description' => "# {$tournament->name} Support Banners\nYayifications",
            'promoted' => true,
            'display_order' => 0,
        ]);

        $type_mappings_json = [
            $master->product_id => [
                'country' => $master_country['name'],
                'tournament_id' => $tournament->tournament_id,
            ],
        ];

        foreach ($countries as $country) {
            $product = factory(Product::class)->states('child_banners')->create([
                'name' => "{$tournament->name} Support Banner ({$country['name']})",
                'master_product_id' => $master->product_id,
            ]);

            $type_mappings_json[$product->product_id] = [
                'country' => $country['name'],
                'tournament_id' => $tournament->tournament_id,
            ];
        }

        $master->type_mappings_json = json_encode($type_mappings_json, JSON_PRETTY_PRINT);
        $master->saveOrExplode();
    }
}
