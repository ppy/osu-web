{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout')

@php
    // always ignore empty keys.
    $hasErrors = count(array_flatten($validationErrors)) > 0
@endphp

@section('content')
    @include("store.header")
    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 osu-layout--store">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1 osu-layout--store">
            <h1>Checkout</h1>

            @if (session()->has('checkout.error.message') || $hasErrors)
                <div class="alert alert-danger">
                    <p>
                        {{ session('checkout.error.message') ?? trans('store.checkout.cart_problems') }}
                    </p>
                </div>
            @endif

            @if ($order->isProcessing())
                <div class="alert alert-danger">
                    <p>
                        {{ trans('store.checkout.pending_checkout.line_1') }}<br>
                        {{ trans('store.checkout.pending_checkout.line_2') }}
                    </p>
                </div>
            @endif

            @include("store.objects.order", ['order' => $order, "table_class" => "table-fancy"])

            <div class="store-cart-footer">
                <div class="store-cart-footer__total-box store-cart-footer__total-box--full">
                    <p class="store-cart-footer__text">total</p>
                    <p class="store-cart-footer__text store-cart-footer__text--amount">{{{ currency($order->getTotal()) }}}</p>

                    @if($order->requiresShipping() && !$order->shipping)
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

    @if(!$order->requiresShipping() || $order->shipping)
        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row osu-layout__row--sm1 osu-layout--store">
            <div class="osu-layout__sub-row osu-layout__sub-row--lg1 osu-layout--store">
                <h1>Select Payment Method</h1>

                @if($checkout->isShippingDelayed() && $order->requiresShipping())
                    @include('store._shipping_delay_warning')
                @endif

                @if($order->address !== null && $order->address->country_code === 'DE')
                    @include('store._shipping_germany_warning')
                @endif

                @if ($hasErrors)
                    {{-- Remove checkout options if there are cart errors --}}
                    <div class="store-checkout-text--error">
                        <p>{{ trans('store.checkout.cart_problems') }}</p>
                        <p>
                            <a href="{{ route('store.cart.show') }}">{{ trans('store.checkout.cart_problems_edit') }}</a>
                        </p>
                    </div>
                @else
                    @foreach ($checkout->allowedCheckoutProviders() as $provider)
                        @include("store.checkout._{$provider}")
                    @endforeach
                @endif
            </div>
        </div>
    @endif
@endsection
