{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="store-payment-method">
    <div class="store-payment-method__cell">
        <button type="button"
                class="js-store-checkout-button store-payment-button store-payment-button--paypal"
                data-provider="paypal"
                data-order-id="{{ $order->order_id }}"
        >
        </button>
    </div>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with PayPal / Credit Card</div>

        <div class="store-text store-text--block">You can complete your transactions using PayPal using <span class="store-text store-text--emphasis">either paypal balance or credit card.</span></div>

        <div class="store-text store-text--block store-text--emphasis">This is the recommended option.</div>
    </div>
</div>
