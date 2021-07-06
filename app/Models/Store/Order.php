<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Store;

use App\Exceptions\InvariantException;
use App\Exceptions\OrderNotModifiableException;
use App\Models\Country;
use App\Models\SupporterTag;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Represents a Store Order.
 *
 * Order states:
 * - cancelled -> Order is cancelled.
 * - incart -> Order is a cart and items can be modified. This is the only state which should allow items to be modified.
 * - processing -> The checkout process for this Order has started.
 * - checkout -> User-side of the payment approval process is complete; awaiting confirmation from payment processor.
 * - paid -> Payment confirmed by payment processor.
 * - shipped -> Physical order dispatched; not available in all cases.
 * - delivered -> If we receive confirmation that the order was delivered; not available in all cases.
 *
 * @property Address $address
 * @property int|null $address_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Illuminate\Database\Eloquent\Collection $items OrderItem
 * @property string|null $last_tracking_state
 * @property int $order_id
 * @property string|null $provider
 * @property \Carbon\Carbon|null $paid_at
 * @property \Illuminate\Database\Eloquent\Collection $payments Payment
 * @property string|null $reference For paypal transactions, this is the resource Id of the paypal order; otherwise, it is the same as the transaction_id without the prefix.
 * @property \Carbon\Carbon|null $shipped_at
 * @property float|null $shipping
 * @property mixed $status
 * @property string|null $tracking_code
 * @property string|null $transaction_id For paypal transactions, this value is based on the IPN or captured payment Id, not the order resource id.
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class Order extends Model
{
    use SoftDeletes;

    const ECHECK_CLEARED = 'ECHECK CLEARED';
    const ORDER_NUMBER_REGEX = '/^(?<prefix>[A-Za-z]+)-(?<userId>\d+)-(?<orderId>\d+)$/';
    const PENDING_ECHECK = 'PENDING ECHECK';

    const PROVIDER_CENTILLI = 'centili';
    const PROVIDER_FREE = 'free';
    const PROVIDER_PAYPAL = 'paypal';
    const PROVIDER_SHOPIFY = 'shopify';
    const PROVIDER_XSOLLA = 'xsolla';

    const STATUS_HAS_INVOICE = ['processing', 'checkout', 'paid', 'shipped', 'cancelled', 'delivered'];

    protected $primaryKey = 'order_id';

    protected $casts = [
        'shipping' => 'float',
    ];

    protected $dates = ['deleted_at', 'shipped_at', 'paid_at'];
    protected $macros = ['itemsQuantities'];

    protected static function splitTransactionId($value)
    {
        return explode('-', $value, 2);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeInCart($query)
    {
        return $query->where('status', 'incart');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeStale($query)
    {
        return $query->where('updated_at', '<', Carbon::now()->subDays(config('store.order.stale_days')));
    }

    public function scopeWhereHasInvoice($query)
    {
        return $query->whereIn('status', static::STATUS_HAS_INVOICE);
    }

    public function scopeWithPayments($query)
    {
        return $query->with('payments');
    }

    public function scopeWhereOrderNumber($query, $orderNumber)
    {
        if (
            !preg_match(static::ORDER_NUMBER_REGEX, $orderNumber, $matches)
            || config('store.order.prefix') !== $matches['prefix']
        ) {
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

        return static::splitTransactionId($this->transaction_id)[0];
    }

    /**
     * Payment status that appears on the invoice.
     *
     * @return string
     */
    public function getPaymentStatusText()
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

    /**
     * Returns the reference id for the provider associated with this Order.
     *
     * @return string|null
     */
    public function getProviderReference(): ?string
    {
        if (!present($this->transaction_id)) {
            return null;
        }

        return static::splitTransactionId($this->transaction_id)[1] ?? null;
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

    public function setTransactionIdAttribute($value)
    {
        // TODO: migrate to always using provider and reference instead of transaction_id.
        $this->attributes['transaction_id'] = $value;

        $split = static::splitTransactionId($value);
        $this->provider = $split[0] ?? null;

        $reference = $split[1] ?? null;
        // For Paypal we're going to use the PAYID number for reference instead of the IPN txn_id
        if ($this->provider !== static::PROVIDER_PAYPAL && $reference !== 'failed') {
            $this->reference = $reference;
        }
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
                $total += $i->quantity * $i->product->next_shipping;
            }
        }

        return (float) $total * $rate;
    }

    public function getTotal()
    {
        return $this->getSubtotal() + $this->shipping;
    }

    public function guardNotModifiable(callable $callable)
    {
        return $this->getConnection()->transaction(function () use ($callable) {
            $locked = $this->exists ? $this->lockSelf() : $this;
            if ($locked->isModifiable() === false) {
                throw new OrderNotModifiableException($locked);
            }

            return $callable();
        });
    }

    public function canCheckout()
    {
        return in_array($this->status, ['incart', 'processing'], true);
    }

    public function canUserCancel()
    {
        return $this->status === 'processing';
    }

    public function hasInvoice()
    {
        return in_array($this->status, static::STATUS_HAS_INVOICE, true);
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

    public function isShopify(): bool
    {
        return $this->getPaymentProvider() === static::PROVIDER_SHOPIFY;
    }

    public function isShouldShopify(): bool
    {
        foreach ($this->items as $item) {
            if ($item->product->shopify_id !== null) {
                return true;
            }
        }

        return false;
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
            $i->saveOrExplode(['skipValidations' => true]);
        }

        if ($this->requiresShipping()) {
            $this->shipping = $this->getShipping();
        } else {
            $this->shipping = null;
        }

        $this->saveOrExplode();
    }

    public function cancel(?User $user = null)
    {
        if ($this->status === 'cancelled') {
            return;
        }

        // TODO: Payment processors should set a context variable flagging the user check to be skipped.
        // This is currently only fine because the Orders controller requires auth.
        if ($user !== null && $this->user_id === $user->getKey() && !$this->canUserCancel()) {
            throw new InvariantException(osu_trans('store.order.cancel_not_allowed'));
        }

        $this->status = 'cancelled';
        $this->saveOrExplode();
    }

    public function delete()
    {
        $this->guardNotModifiable(function () {
            parent::delete();
        });
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
     * The function returns null on success; an error message, otherwise.
     *
     * @param array $itemForm form parameters.
     * @param bool $addToExisting whether the quantity should be added or replaced.
     * @return string|null null on success; error message, otherwise.
     **/
    public function updateItem(array $itemForm, $addToExisting = false)
    {
        return $this->guardNotModifiable(function () use ($itemForm, $addToExisting) {
            $params = static::orderItemParams($itemForm);

            // done first to allow removing of disabled products from cart.
            if ($params['quantity'] <= 0) {
                return $this->removeOrderItem($params);
            }

            // TODO: better validation handling.
            if ($params['product'] === null) {
                return osu_trans('model_validation/store/product.not_available');
            }

            $this->saveOrExplode();

            if ($params['product']->allow_multiple) {
                $item = $this->newOrderItem($params);
            } else {
                $item = $this->updateOrderItem($params, $addToExisting);
            }

            $item->saveOrExplode();
        });
    }

    public function releaseItems()
    {
        // locking bottleneck
        $this->getConnection()->transaction(function () {
            [$items, $products] = $this->lockForReserve();

            $items->each->releaseProduct();
        });
    }

    public function reserveItems()
    {
        // locking bottleneck
        $this->getConnection()->transaction(function () {
            [$items, $products] = $this->lockForReserve();
            $items->each->reserveProduct();
        });
    }

    public function switchItems($orderItem, $newProduct)
    {
        $this->getConnection()->transaction(function () use ($orderItem, $newProduct) {
            $this->lockForReserve([$orderItem->product_id, $newProduct->product_id]);

            $quantity = $orderItem->quantity;
            $orderItem->releaseProduct();
            $orderItem->product()->associate($newProduct);
            $orderItem->reserveProduct();

            $orderItem->saveOrExplode();
        });
    }

    public static function cart($user)
    {
        return static::query()
            ->where('user_id', $user->user_id)
            ->inCart()
            ->with('items.product')
            ->first();
    }

    public function macroItemsQuantities()
    {
        return function ($query) {
            $query = clone $query;

            $order = new self();
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
        optional($this->items()->find($params['id']))->delete();
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
                $targetId = (int) $params['extraData']['target_id'];
                if ($targetId === $this->user_id) {
                    $params['extraData']['username'] = $this->user->username;
                } else {
                    $user = User::default()->where('user_id', $targetId)->firstOrFail();
                    $params['extraData']['username'] = $user->username;
                }

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

        return $this->items()->make([
            'quantity' => $params['quantity'],
            'extra_info' => $params['extraInfo'],
            'extra_data' => $params['extraData'],
            'cost' => $params['cost'],
            'product_id' => $product->product_id,
        ]);
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

    private static function orderItemParams(array $form)
    {
        return [
            'id' => array_get($form, 'id'),
            'quantity' => array_get($form, 'quantity'),
            'product' => Product::enabled()->find(array_get($form, 'product_id')),
            'cost' => intval(array_get($form, 'cost')),
            'extraInfo' => array_get($form, 'extra_info'),
            'extraData' => array_get($form, 'extra_data'),
        ];
    }
}
