{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="store-payment-method">
    <div class="store-payment-method__cell">
        <button type="button"
                class="js-store-checkout-button store-payment-button store-payment-button--xsolla"
                data-provider="xsolla"
                data-order-id="{{ $order->order_id }}"
                data-order-number="{{ $order->getOrderNumber() }}"
        >
        </button>
    </div>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with Xsolla</div>

        <div class="store-text store-text--block">You can complete your transactions using Xsolla</div>

        <div class="store-text store-text--block store-text--emphasis">Some of Xsolla's payment partners</div>
        <div class="store-payment-method__provider-list">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/apple-pay.svg" alt="Apple Pay">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/unionpay.png" alt="UnionPay">
            <img class="store-payment-method__provider" src="/images/store/providers/wechat-pay.png" alt="WeChat Pay">
            <img class="store-payment-method__provider" src="/images/store/providers/bitcoin.png" alt="bitcoin">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/bitcash.svg" alt="BitCash">
        </div>
        <div class="store-text store-text--block">and many more.</div>
    </div>
</div>
