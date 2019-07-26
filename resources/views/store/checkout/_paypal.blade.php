{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
