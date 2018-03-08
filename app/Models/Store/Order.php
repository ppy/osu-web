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

use App\Models\Country;
use App\Models\SupporterTag;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Represents a Store Order.
 *
 * A user should only have 1 'active cart'.
 * The difference between the 'incart', 'processing' and 'checkout' statuses are:
 * - incart -> order is in cart and can be modified; adding a new item will add to the existing order.
 * - processing -> order is in cart and should not be modified.
 * - checkout -> cart is cleared; adding a new item should create a new cart.
 *
 * The contents of the cart should not be cleared until the payment request is
 *  successfully sent to the payment provider.
 * i.e. it should not be cleared immediately on checking out.
 */
class Order extends Model
{
    use SoftDeletes;

    const ECHECK_CLEARED = 'ECHECK CLEARED';
    const ORDER_NUMBER_REGEX = '/^(?<prefix>[A-Za-z]+)-(?<userId>\d+)-(?<orderId>\d+)$/';
    const PENDING_ECHECK = 'PENDING ECHECK';

    protected $primaryKey = 'order_id';

    protected $casts = [
        'shipping' => 'float',
    ];

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

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeInCart($query)
    {
        return $query->whereIn('status', ['incart', 'processing']);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeWithPayments($query)
    {
        return $query->with('payments');
    }

    public function scopeWhereOrderNumber($query, $orderNumber)
    {
        if (!preg_match(static::ORDER_NUMBER_REGEX, $orderNumber, $matches)
            || config('store.order.prefix') !== $matches['prefix']) {
            // hope there's no order_id 0 :D
            return $query->where('order_id', '=', 0);
        }

        $userId = (int) $matches['userId'];
        $orderId = (int) $matches['orderId'];

        return $query->where([
            'order_id' => $orderId,
            'user_id' => $userId,
        ]);
    }

    public function scopeWherePaymentTransactionId($query, $transactionId, $provider)
    {
        return $query
            ->whereIn('order_id', Payment::select('order_id')
                ->where('provider', $provider)
                ->where('transaction_id', $transactionId)
                ->where('cancelled', false));
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

    public function getOrderName()
    {
        return "osu!store order #{$this->order_id}";
    }

    public function getOrderNumber()
    {
        return config('store.order.prefix')."-{$this->user_id}-{$this->order_id}";
    }

    public function getPaymentProvider()
    {
        if (!present($this->transaction_id)) {
            return;
        }

        return studly_case(explode('-', $this->transaction_id)[0]);
    }

    public function getSubtotal($forShipping = false)
    {
        $total = 0;
        foreach ($this->items as $i) {
            if ($forShipping && !$i->product->requiresShipping()) {
                continue;
            }

            $total += $i->subtotal();
        }

        return (float) $total;
    }

    public function requiresShipping()
    {
        foreach ($this->items as $i) {
            if ($i->product->requiresShipping()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the cost of shipping ignoring whether shipping is required or not.
     * Returns 0 if shipping is not required.
     *
     * @return float Shipping cost.
     */
    private function getShipping()
    {
        if (!$this->address) {
            return 0.0;
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

        return (float) $total * $rate;
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case 'cancelled':
                return 'Cancelled';
            case 'checkout':
            case 'processing':
                return 'Awaiting Payment';
            case 'incart':
                return '';
            case 'paid':
            case 'shipped':
            case 'delivered':
                return 'Paid';
            default:
                return 'Unknown';
        }
    }

    public function getTotal()
    {
        return $this->getSubtotal() + $this->shipping;
    }

    public function canCheckout()
    {
        return in_array($this->status, ['incart', 'processing'], true);
    }

    public function isEmpty()
    {
        return !$this->items()->exists();
    }

    public function isAwaitingPayment()
    {
        return in_array($this->status, ['processing', 'checkout'], true);
    }

    public function isModifiable()
    {
        // new cart is status = null
        return in_array($this->status, ['incart', null], true);
    }

    public function isProcessing()
    {
        return $this->status === 'processing';
    }

    public function isPaidOrDelivered()
    {
        return in_array($this->status, ['paid', 'delivered'], true);
    }

    public function isPendingEcheck()
    {
        return $this->tracking_code === static::PENDING_ECHECK;
    }

    public function removeInvalidItems()
    {
        $modified = false;

        //check to make sure we don't have any invalid products in our cart.
        $deleteItems = [];

        foreach ($this->items as $i) {
            if ($i->product === null || !$i->product->enabled) {
                $deleteItems[] = $i;
                continue;
            }

            if (!$i->product->inStock($i->quantity)) {
                $this->updateItem(['product_id' => $i->product_id, 'quantity' => $i->product->stock]);
                $modified = true;
            }
        }

        if (count($deleteItems)) {
            foreach ($deleteItems as $i) {
                $i->delete();
            }

            $modified = true;
        }

        return $modified;
    }

    /**
     * Updates the cost of the order for checkout.
     * Don't call this anywhere except beginning checkout.
     * Do not call it once the payment process has stated.
     *
     * @return void
     */
    public function refreshCost()
    {
        foreach ($this->items as $i) {
            $i->refreshCost();
            $i->saveOrExplode();
        }

        if ($this->requiresShipping()) {
            $this->shipping = $this->getShipping();
        } else {
            $this->shipping = null;
        }

        $this->saveOrExplode();
    }

    public function cancel()
    {
        $this->status = 'cancelled';
        $this->saveOrExplode();
    }

    public function delete()
    {
        if ($this->isModifiable() === false) {
            // in most cases this would return a null key because the lookup for the cart
            // would return a new cart anyway?
            throw new Exception("Delete not allowed on Order ({$this->getKey()}).");
        }

        parent::delete();
    }

    public function paid(Payment $payment = null)
    {
        // TODO: use a no payment object instead?
        if ($payment) {
            // Duplicate to existing fields.
            // TODO: remove/migrate duplicated fields.
            $this->transaction_id = $payment->getOrderTransactionId();
            $this->paid_at = $payment->paid_at;
        } else {
            $this->paid_at = Carbon::now();
        }

        $this->status = $this->requiresShipping() ? 'paid' : 'delivered';
        $this->saveOrExplode();
    }

    /**
     * Updates the Order with form parameters.
     *
     * Updates the Order with with an item extracted from submitted form parameters.
     * The function returns an array containing whether the operation was successful,
     * and a message.
     *
     * @param array $itemForm form parameters.
     * @param bool $addToExisting whether the quantity should be added or replaced.
     * @return array [success, message]
     **/
    public function updateItem(array $itemForm, $addToExisting = false)
    {
        if ($this->isModifiable() === false) {
            // FIXME: better handling.
            return [false, 'Cart cannot be updated at this time.'];
        }

        $params = [
            'id' => array_get($itemForm, 'id'),
            'quantity' => array_get($itemForm, 'quantity'),
            'product' => Product::enabled()->find(array_get($itemForm, 'product_id')),
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
                $item = $this->updateOrderItem($params, $addToExisting);
            }

            $result = $this->validateBeforeSave($params['product'], $item);
            if ($result[0]) {
                $this->save();
                $this->items()->save($item);
            }
        }

        return $result;
    }

    public function releaseItems()
    {
        // locking bottleneck
        DB::connection($this->connection)->transaction(function () {
            list($items, $products) = $this->lockForReserve();

            foreach ($items as $item) {
                $item->product->release($item->quantity);
            }
        });
    }

    public function reserveItems()
    {
        // locking bottleneck
        DB::connection($this->connection)->transaction(function () {
            list($items, $products) = $this->lockForReserve();

            foreach ($items as $item) {
                $item->product->reserve($item->quantity);
            }
        });
    }

    public function switchItems($orderItem, $newProduct)
    {
        DB::connection($this->connection)->transaction(function () use ($orderItem, $newProduct) {
            $this->lockForReserve([$orderItem->product_id, $newProduct->product_id]);

            $quantity = $orderItem->quantity;
            $orderItem->product->release($quantity);
            $orderItem->product()->associate($newProduct);
            $newProduct->reserve($quantity);

            $orderItem->saveOrExplode();
        });
    }

    public static function cart($user)
    {
        $cart = static::query()
            ->where('user_id', $user->user_id)
            ->inCart()
            ->with('items.product')
            ->first();

        if (!$cart) {
            // still stuff that relies on cart not returning null.
            $cart = new static();
            $cart->user_id = $user->user_id;

            return $cart;
        }

        // TODO: maybe should show a notification and only remove
        // when beginning the checkout process?
        if ($cart->removeInvalidItems()) {
            $cart = $cart->fresh();
        }

        return $cart;
    }

    public function macroItemsQuantities()
    {
        return function ($query) {
            $query = clone $query;

            $order = new Order();
            $orderItem = new OrderItem();
            $product = new Product();

            $query
                ->join(
                    $orderItem->getTable(),
                    $order->qualifyColumn('order_id'),
                    '=',
                    $orderItem->qualifyColumn('order_id')
                )
                ->join(
                    $product->getTable(),
                    $orderItem->qualifyColumn('product_id'),
                    '=',
                    $product->qualifyColumn('product_id')
                )
                ->whereNotNull($product->qualifyColumn('weight'))
                ->groupBy($orderItem->qualifyColumn('product_id'))
                ->groupBy($product->qualifyColumn('name'))
                ->select(
                    DB::raw("SUM({$orderItem->qualifyColumn('quantity')}) AS quantity"),
                    $product->qualifyColumn('name'),
                    $orderItem->qualifyColumn('product_id')
                );

            return $query->get();
        };
    }

    private function lockForReserve(array $productIds = null)
    {
        $query = $this->items()->with('product')->lockForUpdate();
        if ($productIds) {
            $query->whereIn('product_id', $productIds);
        }

        $items = $query->get();
        $productIds = array_pluck($items, 'product_id');
        $products = Product::lockForUpdate()->whereIn('product_id', $productIds)->get();

        return [$items, $products];
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
        if ($params['cost'] < 0) {
            $params['cost'] = 0;
        }

        $product = $params['product'];

        // FIXME: custom class stuff should probably not go in Order...
        switch ($product->custom_class) {
            case 'supporter-tag':
                $targetId = $params['extraData']['target_id'];
                $user = User::default()->where('user_id', $targetId)->firstOrFail();
                $params['extraData']['username'] = $user->username;

                $params['extraData']['duration'] = SupporterTag::getDuration($params['cost']);
                break;
            case 'username-change':
                // ignore received cost
                $params['cost'] = $this->user->usernameChangeCost();
                break;
            case 'cwc-supporter':
            case 'mwc4-supporter':
            case 'mwc7-supporter':
            case 'owc-supporter':
            case 'twc-supporter':
                // much dodgy. wow.
                $matches = [];
                preg_match('/.+\((?<country>.+)\)$/', $product->name, $matches);
                $params['extraData']['cc'] = Country::where('name', $matches['country'])->first()->acronym;
                $params['cost'] = $product->cost ?? 0;
                break;
            default:
                $params['cost'] = $product->cost ?? 0;
        }

        $item = new OrderItem();
        $item->quantity = $params['quantity'];
        $item->extra_info = $params['extraInfo'];
        $item->extra_data = $params['extraData'];
        $item->cost = $params['cost'];
        $item->product()->associate($product);

        return $item;
    }

    private function updateOrderItem(array $params, $addToExisting = false)
    {
        $product = $params['product'];
        $item = $this->items()->where('product_id', $product->product_id)->get()->first();
        if ($item === null) {
            return $this->newOrderItem($params);
        }

        if ($addToExisting) {
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
            $route = route('store.cart.show');

            return [false, "you can only order {$product->max_quantity} of this item per order. visit your <a href='{$route}'>shopping cart</a> to confirm your current order"];
        }

        return [true, ''];
    }
}
