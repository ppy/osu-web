{{--
    Copyright 2015 ppy Pty. Ltd.

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
                <div class="row">
                    <div class="col-md-12"><h2>Shipping Address</h2></div>
                </div>

                @if(count($addresses))
                    <div class="row address-list">
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
                <h1>Payment</h1>

                @if($delayedShipping)
                <div class="alert alert-warning">
                    <p><strong>IMPORTANT: SHIPPING DELAYS</strong></p>

                    <p>
                        {!! Markdown::convertToHtml(env('DELAYED_SHIPPING_ORDER_MESSAGE', config('store.delayed_shipping_order_message', trans('store.checkout.delayed_shipping')))) !!}
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

                <div class="big-button">
                    @if($order->getTotal() > 0)
                        <form class="text-center noajax" id="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="5DD65FGXND4GS">
                            <input type="hidden" name="lc" value="AU">
                            <input type="hidden" name="button_subtype" value="services">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="{{{ action("StoreController@getInvoice", [$order->order_id]) }}}?thanks=1">
                            <input type="hidden" name="cancel_return" value="{{{ action("StoreController@getCheckout") }}}">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHosted">
                            <input type="hidden" id="paypal_name" name="item_name" value="osu!store order #{{{$order->order_id}}}">
                            <input type="hidden" id="paypal_code" name="item_number" value="store-{{{$order->user_id}}}-{{{$order->order_id}}}">
                            <input type="hidden" id="paypal_amount" name="amount" value="{{{$order->getSubtotal()}}}">
                            <input type="hidden" id="paypal_shipping" name="shipping" value="{{{$order->getShipping()}}}">
                            <a href="/store/checkout" class="btn-osu btn-osu-danger paypal-button" id="checkout-with-paypal" data-method="post" data-remote="1">
                                {{ trans("store.checkout.pay") }}
                            </a>
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    @else
                        {!! Form::open(["url" => "store/checkout", "data-remote" => true]) !!}
                            <input type="hidden" name="completed" value="1">
                            <button type="submit" class="btn-osu btn-osu-danger">Complete Order</button>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection
