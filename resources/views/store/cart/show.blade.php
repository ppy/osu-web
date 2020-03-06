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
@extends('store.layout')

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
                    {{ trans('store.cart.title') }}
                </h1>

                <p>{{ trans('store.cart.empty.text') }}</p>
                <p>{!! trans('store.cart.empty.return_link._', [
                    'link' => Html::link(route('store.products.index'), trans('store.cart.empty.return_link.link_text')),
                    ]) !!}
                </p>
            </div>
        @else
            <div class="store-page">
                <h1 class="store-text store-text--title">
                    {{ trans('store.cart.title') }}
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
                        <a href="{{ route('store.products.index') }}">{{ trans('store.cart.more_goodies') }}</a>
                    </p>

                    <div class="store-cart-footer__total-box store-cart-footer__total-box--padded">
                        <p class="store-cart-footer__text">{{ trans('store.cart.total') }}</p>

                        <p class="store-cart-footer__text store-cart-footer__text--amount">
                            {{ currency($order->getSubtotal()) }}
                        </p>

                        @if($order->requiresShipping())
                            <p class="store-cart-footer__text store-cart-footer__text--shipping">
                                + {{ trans('store.cart.shipping_fees') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="store-page store-page--footer">
                @if ($hasErrors)
                    <ul class="store-page__alert">
                        @foreach (trans('store.cart.errors_no_checkout') as $_k => $v)
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
                        {{ trans('store.cart.checkout' ) }}
                    </button>
                @endif
            </div>
        @endif
    </div>
@endsection
