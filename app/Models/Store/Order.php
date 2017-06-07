<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Store;

use App\Models\User;
use DB;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    protected $dates = ['deleted_at', 'shipped_at', 'paid_at'];
    public $macros = ['itemsQuantities'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trackingCodes()
    {
        $codes = [];
        preg_match_all('/([A-Z]{2}[A-Z0-9]{9,11})/', $this->tracking_code, $codes);

        return $codes[0];
    }

    public function getItemCount()
    {
        $total = 0;
        foreach ($this->items as $i) {
            $total += $i->quantity;
        }

        return $total;
    }

    public function getSubtotal()
    {
        $total = 0;
        foreach ($this->items as $i) {
            $total += $i->subtotal();
        }

        return $total;
    }

    public function requiresShipping()
    {
        foreach ($this->items as $i) {
            if ($i->product->weight !== null) {
                return true;
            }
        }

        return false;
    }

    public function getShipping()
    {
        if (!$this->address) {
            return 0;
        }

        $rate = $this->address->shippingRate();

        $total = 0;

        $primaryShipping = 0;
        $nextShipping = 0;

        //first find the highest shipping cost, and use that as a base
        foreach ($this->items as $i) {
            if ($i->product->base_shipping > $primaryShipping) {
                $primaryShipping = $i->product->base_shipping;
            }
        }

        //then add up the total
        foreach ($this->items as $i) {
            if ($primaryShipping === $i->product->base_shipping) {
                $total += $i->product->base_shipping * 1 + ($i->quantity - 1) * $i->product->next_shipping;
            } else {
                $total += ($i->quantity) * $i->product->next_shipping;
            }
        }

        return $total * $rate;
    }

    public function getTotal()
    {
        return $this->getSubtotal() + $this->shipping;
    }

    public function refreshCost($save = false)
    {
        foreach ($this->items as $i) {
            $i->refreshCost();
            if ($save) {
                $i->save();
            }
        }
        $this->shipping = $this->getShipping();
        if ($save) {
            $this->save();
        }
    }

    public function checkout()
    {
        DB::transaction(function () {
            $this->status = 'checkout';
            $this->refreshCost(true);
        });
    }

    /**
     * Updates the Order with form parameters.
     *
     * Updates the Order with with an item extracted from submitted form parameters.
     * The function returns an array containing whether the operation was successful,
     * and a message.
     *
     * @param array $itemForm form parameters.
     * @param bool $addNew whether the quantity should be added or replaced.
     * @return array [success, message]
     **/
    public function updateItem(array $itemForm, $addNew = false)
    {
        $params = [
            'id' => array_get($itemForm, 'id'),
            'quantity' => array_get($itemForm, 'quantity'),
            'product' => Product::find(array_get($itemForm, 'product_id')),
            'cost' => intval(array_get($itemForm, 'cost')),
            'extraInfo' => array_get($itemForm, 'extra_info'),
            'extraData' => array_get($itemForm, 'extra_data'),
        ];

        if ($params['product'] === null) {
            return [false, 'no product'];
        }

        $result = [true, ''];

        if ($params['quantity'] <= 0) {
            $this->removeOrderItem($params);
        } else {
            if ($params['product']->allow_multiple) {
                $item = $this->newOrderItem($params);
            } else {
                $item = $this->updateOrderItem($params, $addNew);
            }

            $result = $this->validateBeforeSave($params['product'], $item);
            if ($result[0]) {
                $this->save();
                $this->items()->save($item);
            }
        }

        return $result;
    }

    public static function cart($user)
    {
        $cart = static::query()
            ->where('user_id', $user->user_id)
            ->where('status', 'incart')
            ->with('items.product')
            ->first();

        if ($cart) {
            $requireFresh = false;

            //check to make sure we don't have any invalid products in our cart.
            $deleteItems = [];

            foreach ($cart->items as $i) {
                if ($i->product === null) {
                    $deleteItems[] = $i;
                    continue;
                }

                if (!$i->product->enabled) {
                    $deleteItems[] = $i;
                    continue;
                }

                if (!$i->product->inStock($i->quantity)) {
                    $cart->updateItem(['product_id' => $i->product_id, 'quantity' => $i->product->stock]);
                    $requireFresh = true;
                }
            }

            if (count($deleteItems)) {
                foreach ($deleteItems as $i) {
                    $i->delete();
                }

                $requireFresh = true;
            }

            if ($requireFresh) {
                $cart = $cart->fresh();
            }
        }

        if ($cart) {
            $cart->refreshCost();
        } else {
            $cart = new self();
            $cart->user_id = $user->user_id;
        }

        return $cart;
    }

    public function macroItemsQuantities()
    {
        return function ($query) {
            $query = clone $query;

            $ordersTable = (new Order)->getTable();
            $orderItemsTable = (new OrderItem)->getTable();
            $productsTable = (new Product)->getTable();

            $query
                ->join($orderItemsTable, "{$ordersTable}.order_id", '=', "{$orderItemsTable}.order_id")
                ->join($productsTable, "{$orderItemsTable}.product_id", '=', "${productsTable}.product_id")
                ->groupBy("{$orderItemsTable}.product_id")
                ->groupBy('name')
                ->select(DB::raw("SUM({$orderItemsTable}.quantity) AS quantity, name, {$orderItemsTable}.product_id"));

            return $query->get();
        };
    }

    private function removeOrderItem(array $params)
    {
        $itemId = $params['id'];
        $item = $this->items()->find($itemId);

        if ($item) {
            $item->delete();
        }

        if ($this->items()->count() === 0) {
            $this->delete();
        }
    }

    private function newOrderItem(array $params)
    {
        $product = $params['product'];

        // FIXME: custom class stuff should probably not go in Order...
        if ($product->custom_class === 'supporter-tag') {
            $targetUsername = $params['extraData']['username'];
            $user = User::where('username', $targetUsername)->first();
            // TODO: burst into flames if user is null
            $params['extraData']['target_id'] = $user->user_id;
        }

        $item = new OrderItem();
        $item->quantity = $params['quantity'];
        $item->extra_info = $params['extraInfo'];
        $item->extra_data = $params['extraData'];
        $item->product()->associate($product);
        if ($product->cost === null) {
            $item->cost = $params['cost'];
        }

        return $item;
    }

    private function updateOrderItem(array $params, $addNew = false)
    {
        $product = $params['product'];
        $item = $this->items()->where('product_id', $product->product_id)->get()->first();
        if ($item === null) {
            return $this->newOrderItem($params);
        }

        if ($addNew) {
            $item->quantity += $params['quantity'];
        } else {
            $item->quantity = $params['quantity'];
        }

        return $item;
    }

    private function validateBeforeSave(Product $product, $item)
    {
        if (!$product->inStock($item->quantity)) {
            return [false, 'not enough stock'];
        } elseif (!$product->enabled) {
            return [false, 'invalid item'];
        } elseif ($item->quantity > $product->max_quantity) {
            return [false, "you can only order {$product->max_quantity} of this item per order. visit your <a href='/store/cart'>shopping cart</a> to confirm your current order"];
        }

        return [true, ''];
    }
}
