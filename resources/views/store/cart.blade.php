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

@php
    // always ignore empty keys.
    $hasErrors = count(array_flatten($validationErrors)) > 0;
    $itemErrors = $validationErrors['orderItems'] ?? [];
@endphp

@section("content")
    @include("store.header")

    @if(!$order || !count($order->items))
        <div class="osu-layout__row osu-layout__row--page">
            <h1>Shopping Cart</h1>

            <p>Your cart is empty.</p>
            <p>Return to the <a href="/store/">store listing</a> to find some goodies!</p>
        </div>
    @else
        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1">
            <div class="osu-layout__sub-row osu-layout__sub-row--lg1">
                <h1>Shopping Cart</h1>

                <ul class="table cart-items">
                    @foreach($order->items as $i)
                        <li class="store-order-item">
                            <div class="store-order-item__line">
                                <span class="store-order-item__name">
                                    {{{$i->getDisplayName()}}}
                                </span>

                                {!! Form::open(['class' => 'store-order-item__options', "url" => "store/update-cart", "data-remote" => true]) !!}
                                    <input type="hidden" name="item[product_id]" value="{{ $i->product_id }}">
                                    <input type="hidden" name="item[id]" value="{{ $i->id }}">
                                    @if($i->product->allow_multiple)
                                        <span class="store-order-item__quantity">{{{ trans_choice('common.count.item', $i->quantity) }}}</span>
                                    @else
                                        {!! Form::select("item[quantity]", product_quantity_options($i->product), $i->quantity, ['class' => 'store-order-item__quantity form-control js-auto-submit']) !!}
                                    @endif
                                    <span class="store-order-item__subtotal">{{{currency($i->subtotal())}}}</span>
                                    <button type="submit" class="btn btn-flat" name="item[quantity]" value="0"><i class="fas fa-times"></i></button>
                                {!! Form::close() !!}
                            </div>

                            @if (isset($itemErrors[$i->id]))
                                <div class="store-order-item__line">
                                    <ul class="store-order-item__errors">
                                        @foreach ($itemErrors[$i->id] as $message)
                                            <li class="store-order-item__error">{!! $message !!}
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="store-cart-footer">
                    <p>
                        <a href='/store/listing'>I want to check out more goodies before completing the order</a>
                    </p>

                    <div class="store-cart-footer__total-box store-cart-footer__total-box--padded">
                        <p class="store-cart-footer__text">total</p>

                        <p class="store-cart-footer__text store-cart-footer__text--amount">
                            {{{ currency($order->getSubtotal()) }}}
                        </p>

                        @if($order->requiresShipping())
                            <p class="store-cart-footer__text store-cart-footer__text--shipping">
                                + shipping fees
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="osu-layout__sub-row">
                @if ($hasErrors)
                    Cannot checkout out while cart has errors
                @else
                    <div class="big-button">
                        <a href="{{ route('store.checkout.show') }}" class="btn-osu btn-osu-default" name="checkout">Checkout</a>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
