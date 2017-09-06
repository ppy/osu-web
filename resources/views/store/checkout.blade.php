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
@extends("master")

@section("content")
    @include("store.header")

    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1">
            <h1>Checkout</h1>

            @include("store.objects.order", ['order' => $order, "table_class" => "table-fancy"])

            <div class="store-cart-footer">
                <div class="store-cart-footer__total-box store-cart-footer__total-box--full">
                    <p class="store-cart-footer__text">total</p>
                    <p class="store-cart-footer__text store-cart-footer__text--amount">{{{ currency($order->getTotal()) }}}</p>

                    @if($order->requiresShipping() && !$order->getShipping())
                        <p class="store-cart-footer__text store-cart-footer__text--shipping">+ shipping fees</p>
                    @endif
                </div>
            </div>
        </div>

        @if ($order->requiresShipping())
            <div class="osu-layout__sub-row">
                <div class="grid grid--gutters">
                    <div class="grid-cell grid-cell--fill"><h2>Shipping Address</h2></div>
                </div>

                @if(count($addresses))
                    <div class="grid grid--gutters address-list">
                        @foreach($addresses as $a)
                        @include('store.objects.address', ['data' => $a, 'selected' => ($order->address && $order->address->address_id == $a->address_id), 'modifiable' => true])
                        @endforeach
                    </div>
                @endif

                @include('store.objects.new_address')
            </div>
        @endif
    </div>

    @if(!$order->requiresShipping() || $order->getShipping())
        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row osu-layout__row--sm1">
            <div class="osu-layout__sub-row osu-layout__sub-row--lg1">
                <h1>Select Payment Method</h1>

                @if($checkout->isShippingDelayed() && $order->requiresShipping())
                <div class="alert alert-warning">
                    <p><strong>IMPORTANT: SHIPPING DELAYS</strong></p>

                    <p>
                        {!! Markdown::convertToHtml(config('store.delayed_shipping_order_message') ?: trans('store.checkout.delayed_shipping')) !!}
                    </p>

                    <p>
                        <input type='checkbox' class='js-checkout-confirmation-step' id='delay-warning'/> <label for='delay-warning'>I have read and understand this message</label>
                    </p>
                </div>
                @endif

                @if($order->address !== null && $order->address->country_code === 'DE')
                    <div class="alert alert-warning">
                        <p><strong>NOTE TO GERMAN CUSTOMERS</strong></p>

                        <p>
                            We have recently been notified of issues regarding deliveries within Germany, possibly due to a change in German customs regulations. Multiple cases have been reported where packages are not delivered to the addressee, but instead to a customs house. The addressee is then sent a notice to pick up the item in person and pay an import sales tax. Unfortunately international customs procedures are out of our control, but <strong>please take this into account when placing your order</strong>.
                        </p>

                        <p>
                            <input type='checkbox' class='js-checkout-confirmation-step' id='german-warning'/> <label for='german-warning'>I have read and understand this message</label>
                        </p>
                    </div>
                @endif

                @if ($order->getTotal() > 0)
                    @include('store._checkout-paypal')
                    @include('store._checkout-centili')
                    @include('store._checkout-xsolla')
                @else
                    <div class="big-button">
                        {!! Form::open(["url" => "store/checkout", "data-remote" => true]) !!}
                            <input type="hidden" name="completed" value="1">
                            <button type="submit" class="btn-osu btn-osu-danger">Complete Order</button>
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
