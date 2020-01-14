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

<div class="alert alert-warning">
    <p><em class="store-text store-text--emphasis">IMPORTANT: SHIPPING DELAYS</em></p>

    <p>
        {!! markdown(config('store.delayed_shipping_order_message') ?: trans('store.checkout.delayed_shipping')) !!}
    </p>

    <p>
        <input type='checkbox' class='js-checkout-confirmation-step' id='delay-warning'/> <label for='delay-warning'>I have read and understand this message</label>
    </p>
</div>
