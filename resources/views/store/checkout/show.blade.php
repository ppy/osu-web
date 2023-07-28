{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout', ['titlePrepend' => osu_trans('store.checkout.title_compact')])

@php
    // always ignore empty keys.
    $hasErrors = count(array_flatten($validationErrors)) > 0
@endphp

@section('content')
    @include('store.header')
    <div class="osu-page osu-page--store">
        <div class="store-page">
            <h1 class="store-text store-text--title">Checkout</h1>

            @if (session()->has('checkout.error.message') || $hasErrors)
                <ul class="store-page__alert store-page__alert--with-margin-bottom">
                    <li>
                        {{ session('checkout.error.message') ?? osu_trans('store.checkout.cart_problems') }}
                    </li>
                </ul>
            @endif

            @if ($order->isPaymentRequested())
                <ul class="store-page__alert store-page__alert--with-margin-bottom">
                    <li>
                        {{ osu_trans('store.checkout.pending_checkout.line_1') }}<br>
                        {{ osu_trans('store.checkout.pending_checkout.line_2') }}
                    </li>
                </ul>
            @endif

            @include("store.objects.order", ['order' => $order, 'modifiers' => ['checkout']])

            @if ($order->containsSupporterTag())
                <label class="store-page__option">
                    @include('objects._switch', ['locals' => [
                        'additionalClass' => 'js-hide-from-activity',
                        'checked' => $order->isHideSupporterFromActivity(),
                        'name' => 'hide_from_activity',
                    ]])
                    {{ osu_trans('store.checkout.hide_from_activity') }}
                </label>
            @endif

            <div class="store-cart-footer">
                <div class="store-cart-footer__total-box store-cart-footer__total-box--full">
                    <p class="store-cart-footer__text">total</p>
                    <p class="store-cart-footer__text store-cart-footer__text--amount">{{{ currency($order->getTotal()) }}}</p>
                </div>
            </div>
        </div>

        <div class="store-page store-page--footer">
            <h1 class="store-text store-text--title">Select Payment Method</h1>

            @if ($hasErrors)
                {{-- Remove checkout options if there are cart errors --}}
                <div class="store-checkout-text--error">
                    <p>{{ osu_trans('store.checkout.cart_problems') }}</p>
                    <p>
                        <a href="{{ route('store.cart.show') }}">{{ osu_trans('store.checkout.cart_problems_edit') }}</a>
                    </p>
                </div>
            @else
                @foreach ($checkout->allowedCheckoutProviders() as $provider)
                    @include("store.checkout._{$provider}")
                @endforeach
            @endif
        </div>
    </div>
@endsection
