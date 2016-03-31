<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql-store';
    protected $primaryKey = 'order_id';

    protected $casts = [
        'order_id' => 'integer',
        'user_id' => 'integer',
        'address_id' => 'integer',

        'shipping' => 'float',
    ];

    protected $dates = ['deleted_at', 'shipped_at', 'paid_at'];

    public function items()
    {
        return $this->hasMany('App\Models\Store\OrderItem', 'order_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Store\Address');
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User");
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

    public function updateItem($item_form, $add_new = false)
    {
        $quantity = intval(array_get($item_form, 'quantity'));
        $product = Product::find(array_get($item_form, 'product_id'));
        $extraInfo = array_get($item_form, 'extra_info');

        $result = [true, ''];

        if ($product) {
            if ($quantity <= 0) {
                $item = $this->items()->where('product_id', $product->product_id)->get()->first();

                if ($item) {
                    $item->delete();
                }

                if ($this->items()->count() === 0) {
                    $this->delete();
                }
            } else {
                $item = $this->items()->where('product_id', $product->product_id)->get()->first();
                if ($item) {
                    if ($add_new) {
                        $item->quantity += $quantity;
                    } else {
                        $item->quantity = $quantity;
                    }
                } else {
                    $item = new OrderItem();
                    $item->quantity = $quantity;
                    $item->extra_info = $extraInfo;
                    $item->product()->associate($product);
                    if ($product->cost === null) {
                        $item->cost = intval($item_form['cost']);
                    }
                }

                if (!$product->inStock($item->quantity)) {
                    $result = [false, 'not enough stock'];
                } elseif (!$product->enabled) {
                    $result = [false, 'invalid item'];
                } elseif ($item->quantity > $product->max_quantity) {
                    $result = [false, "you can only order {$product->max_quantity} of this item per order. visit your <a href='/store/cart'>shopping cart</a> to confirm your current order"];
                } else {
                    $this->save();
                    $this->items()->save($item);
                }
            }
        } else {
            $result = [false, 'no product'];
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

    public static function itemsQuantities($orders)
    {
        $query = clone $orders;

        $query
            ->join('order_items', 'orders.order_id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.product_id')
            ->groupBy('order_items.product_id')
            ->groupBy('name')
            ->select(DB::raw('sum(order_items.quantity) as quantity, name, products.product_id'));

        return $query->get();
    }
}
