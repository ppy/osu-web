{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="alert alert-warning">
    <p><strong>IMPORTANT: SHIPPING DELAYS</strong></p>

    <p>
        {!! markdown(config('store.delayed_shipping_order_message') ?: trans('store.checkout.delayed_shipping')) !!}
    </p>

    <p>
        <input type='checkbox' class='js-checkout-confirmation-step' id='delay-warning'/> <label for='delay-warning'>I have read and understand this message</label>
    </p>
</div>
