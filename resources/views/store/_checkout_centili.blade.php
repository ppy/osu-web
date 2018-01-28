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
    <div class="store-payment-method__cell">
        <button type="button"
                class="js-store-checkout-button store-payment-button store-payment-button--centili"
                data-provider="centili"
                data-url="{{ $checkout->getCentiliPaymentLink() }}"
        >
    </div>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with ¥COINS</div>

        <div class="store-text store-text--block">You can complete your transactions using ¥COINS</div>

        <div class="store-text store-text--block store-text--emphasis">Powered by</div>
        <div class="store-payment-method__provider-list">
            <img class="store-payment-method__provider" src="/images/store/providers/webmoney.png" alt="WebMomey">
            <img class="store-payment-method__provider" src="/images/store/providers/softbank.png" alt="Softbank">
        </div>
        <div class="store-payment-method__provider-list">
            <img class="store-payment-method__provider" src="/images/store/providers/docomo.png" alt="Docomo">
            <img class="store-payment-method__provider" src="/images/store/providers/au.png" alt="au">
        </div>
    </div>
</div>
