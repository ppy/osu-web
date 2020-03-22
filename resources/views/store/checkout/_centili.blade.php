{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="store-payment-method">
    <div class="store-payment-method__cell">
        <button type="button"
                class="js-store-checkout-button store-payment-button store-payment-button--centili"
                data-provider="centili"
                data-order-id="{{ $order->order_id }}"
                data-url="{{ $checkout->getCentiliPaymentLink() }}"
        >
    </div>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with ¥COINS</div>

        <div class="store-text store-text--block">You can complete your transactions using ¥COINS</div>

        <div class="store-text store-text--block store-text--emphasis">Powered by</div>
        <div class="store-payment-method__provider-list">
            <img
                class="store-payment-method__provider store-payment-method__provider--light"
                src="/images/store/providers/webmoney.png"
                alt="WebMoney"
            >
            <img
                class="store-payment-method__provider store-payment-method__provider--light"
                src="/images/store/providers/softbank.png"
                alt="Softbank"
            >
        </div>
        <div class="store-payment-method__provider-list">
            <img
                class="store-payment-method__provider"
                src="/images/store/providers/docomo.png"
                alt="Docomo"
            >
            <img
                class="store-payment-method__provider"
                src="/images/store/providers/au.png"
                alt="au"
            >
        </div>
    </div>
</div>
