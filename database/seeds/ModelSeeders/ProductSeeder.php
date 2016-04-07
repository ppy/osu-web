<?php

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
        $this->product_ids = [];
        $this->count = 0;

        $master_tshirt = factory(App\Models\Store\Product::class, 'master_tshirt')->create();
        $child_shirts = factory(App\Models\Store\Product::class, 'child_tshirt', 7)->create([
            'master_product_id' => $master_tshirt->product_id,
        ])->each(function ($s) {
            $this->product_ids[] = $s->product_id;
            ++$this->count;
        });

        // Add the child shirt IDs to the master shirt's type_mappings_json
        $type_mappings_json = [];
        $sizes = ['S', 'M', 'L', 'XL'];
        $i = 1;
        $y = 1;
        $type_mappings_json[$master_tshirt->product_id] = [
            'size' => 'S',
            'colour' => 'White',
        ];
        foreach ($this->product_ids as $id) {
            if ($i === 4) {
                // Reset the counter back to 0 after every 4 so sizes are cycled
                $i = 0;
            }
            if ($y <= 3) {
                $colour = 'White';
            } else {
                $colour = 'Charcoal';
            }
            $type_mappings_json[$id] = [
                'size' => $sizes[$i],
                'colour' => $colour,
            ];
            ++$i;
            ++$y;
        }
        $master_tshirt->type_mappings_json = json_encode($type_mappings_json, JSON_PRETTY_PRINT);
        $master_tshirt->save();

        try {
        } catch (\Illuminate\Database\QueryException $e) {
            echo $e->getMessage()."\r\n";
        } catch (Exception $ex) {
            echo $ex->getMessage()."\r\n";
        }
    }
}
