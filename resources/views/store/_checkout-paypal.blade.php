{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}

<div class="store-payment-method">
    <div class="store-payment-method__cell store-payment-button store-payment-button--paypal">
        <form class="text-center noajax" id="paypal-form" action="{{ config('payments.paypal.url') }}" method="post" target="_top">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="{{ config('payments.paypal.merchant_id') }}">
            <input type="hidden" name="lc" value="AU">
            <input type="hidden" name="button_subtype" value="services">
            <input type="hidden" name="no_note" value="0">
            <input type="hidden" name="cn" value="Add special instructions to the seller:">
            <input type="hidden" name="no_shipping" value="2">
            <input type="hidden" name="rm" value="1">
            <input type="hidden" name="return" value="{{ action("StoreController@getInvoice", [$order->order_id]) }}?thanks=1">
            <input type="hidden" name="cancel_return" value="{{ action("StoreController@getCheckout") }}">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHosted">
            <input type="hidden" id="paypal_name" name="item_name" value="{{ $order->getOrderName() }}">
            <input type="hidden" id="paypal_code" name="item_number" value="{{ $order->getOrderNumber() }}">
            <input type="hidden" id="paypal_amount" name="amount" value="{{ $order->getSubtotal() }}">
            <input type="hidden" id="paypal_shipping" name="shipping" value="{{ $order->getShipping() }}">
            {{-- <a href="/store/checkout" id="checkout-with-paypal" data-method="post" data-remote="1"> --}}
            {{-- </a> --}}
        </form>
    </div>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with PayPal / Credit Card</div>

        <div class="store-text store-text--block">You can complete your transactions using PayPal using <span class="store-text store-text--emphasis">either paypal balance or credit card.</span></div>

        <div class="store-text store-text--block store-text--emphasis">This is the recommended option.</div>
    </div>
</div>
