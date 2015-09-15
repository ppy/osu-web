{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")
    @include("store.header")

    @if(!$order || !count($order->items))
        <div class="row-page">
            <div class="col-md-12">
                <h1>Shopping Cart</h1>
            </div>

            <p>Your cart is empty.</p>
            <p>Return to the <a href="/store/">store listing</a> to find some goodies!</p>
        </div>
    @else
        <div class="row-page row-group">
            <div class="row-subgroup row-subgroup--large clearfix">
                <div class="col-md-12">
                    <h1>Shopping Cart</h1>
                </div>

                <div class="col-md-12">
                    <ul class='table cart-items'>
                        @foreach($order->items as $i)
                        <li>
                            <span class="product-name">
                                {{{$i->getDisplayName()}}}
                            </span>

                            {!! Form::open(["url" => "store/update-cart", "data-remote" => true]) !!}
                                <input type="hidden" name="item[product_id]" value="{{ $i->product_id }}">

                                {!! Form::select("item[quantity]", product_quantity_options($i->product), $i->quantity, ['class' => 'item-quantity form-control js-auto-submit']) !!}
                                <span class="subtotal">{{{currency($i->subtotal())}}}</span>
                                <button type="submit" class="btn btn-flat" name="item[quantity]" value="0"><i class="fa fa-remove"></i></button>
                            {!! Form::close() !!}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-12 cart-footer">
                    <div class="row">
                        <div class="col-sm-8">
                            <p>
                                <a href='/store/listing'>I want to check out more goodies before completing the order</a>
                            </p>
                        </div>
                        <div class="col-sm-4 total-box">
                            <p>total</p>
                            <p>{{{ currency($order->getSubtotal()) }}}</p>
                            @if($order->requiresShipping())
                                <p>+ shipping fees</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-subgroup">
                <div class="big-button">
                    <a href="/store/checkout" class="btn-osu btn-osu-default" name="checkout">Checkout</a>
                </div>
            </div>
        </div>
    @endif
@endsection
