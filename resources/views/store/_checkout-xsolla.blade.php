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
    <button type="button"
            class="js-store-checkout-button store-payment-method__cell store-payment-button store-payment-button--xsolla"
            data-provider="xsolla"
            data-order-number="{{ $order->getOrderNumber() }}"
    >
    </button>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with xsolla</div>

        <div class="store-text store-text--block">You can complete your transactions using Xsolla</div>

        <div class="store-text store-text--block store-text--emphasis">Some of Xsolla's payment parters</div>
        <div class="store-payment-method__provider-list">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/apple-pay.png" alt="Apple Pay">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/unionpay.png" alt="UnionPay">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/wechat-pay.png" alt="WeChat Pay">
            <img class="store-payment-method__provider" src="/images/store/providers/bitcoin.png" alt="bitcoin">
            <img class="store-payment-method__provider store-payment-method__provider--tall" src="/images/store/providers/bitcash.png" alt="BitCash">
        </div>
        <div class="store-text store-text--block">any many more.</div>
    </div>
</div>
