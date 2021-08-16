{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store.layout', ['titlePrepend' => osu_trans('layout.header.store.cart')])

@php
    // always ignore empty keys.
    $hasErrors = count(array_flatten($validationErrors)) > 0;
    $itemErrors = $validationErrors['orderItems'] ?? [];
@endphp

@section('content')
    @include("store.header")

    <div class="osu-page osu-page--store">
        @if(!$order || !count($order->items))
            <div class="store-page">
                <h1 class="store-text store-text--title">
                    {{ osu_trans('store.cart.title') }}
                </h1>

                <p>{{ osu_trans('store.cart.empty.text') }}</p>
                <p>{!! osu_trans('store.cart.empty.return_link._', [
                    'link' => Html::link(route('store.products.index'), osu_trans('store.cart.empty.return_link.link_text')),
                    ]) !!}
                </p>
            </div>
        @else
            <div class="store-page">
                <h1 class="store-text store-text--title">
                    {{ osu_trans('store.cart.title') }}
                </h1>

                <ul class="cart-items">
                    @foreach($order->items as $item)
                        <li class="cart-items__item">
                            @include('store.cart._item', compact('item'))
                        </li>
                    @endforeach
                </ul>

                <div class="store-cart-footer">
                    <p>
                        <a href="{{ route('store.products.index') }}">{{ osu_trans('store.cart.more_goodies') }}</a>
                    </p>

                    <div class="store-cart-footer__total-box store-cart-footer__total-box--padded">
                        <p class="store-cart-footer__text">{{ osu_trans('store.cart.total') }}</p>

                        <p class="store-cart-footer__text store-cart-footer__text--amount">
                            {{ currency($order->getSubtotal()) }}
                        </p>

                        @if($order->requiresShipping())
                            <p class="store-cart-footer__text store-cart-footer__text--shipping">
                                + {{ osu_trans('store.cart.shipping_fees') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="store-page store-page--footer">
                @if ($hasErrors)
                    <ul class="store-page__alert">
                        @foreach (osu_trans('store.cart.errors_no_checkout') as $_k => $v)
                            <li>{{ $v }}</li>
                        @endforeach
                    </ul>
                @else
                    <button
                        class="js-store-checkout btn-osu-big btn-osu-big--store-action"
                        data-order-id="{{ $order->order_id }}"
                        data-shopify="{{ $order->isShouldShopify() }}"
                        disabled
                    >
                        {{ osu_trans('store.cart.checkout' ) }}
                    </button>
                @endif
            </div>
        @endif
    </div>
@endsection
