<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Store;

/**
 * Records transaction data from payment providers.
 *
 * @property bool $cancelled
 * @property string|null $country_code
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property Order $order
 * @property int $order_id
 * @property \Carbon\Carbon $paid_at
 * @property string $provider
 * @property string $transaction_id
 * @property \Carbon\Carbon|null $updated_at
 */
class Payment extends Model
{
    protected $casts = [
        'cancelled' => 'boolean',
    ];
    protected $dates = ['paid_at'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getOrderTransactionId()
    {
        return "{$this->provider}-{$this->transaction_id}";
    }

    public function cancel()
    {
        $payment = $this->replicate();
        $payment->cancelled = true;
        $payment->saveOrExplode();
    }
}
