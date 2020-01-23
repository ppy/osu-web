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
{!! Form::open([
    'class' => 'store-order-item js-store-order-item',
    'url' => route('store.cart.store'),
    'data-remote' => true,
    'data-shopify-id'=> $item->product->shopify_id,
    'data-quantity'=> $item->quantity,
]) !!}
    <input type="hidden" name="item[product_id]" value="{{ $item->product_id }}">
    <input type="hidden" name="item[id]" value="{{ $item->id }}">

    <span class="store-order-item__name">
        {{ $item->getDisplayName() }}
    </span>

    <div class="store-order-item__quantity">
    {{-- anything where stock is null either allows multiple or is max_quantity 1--}}
        @if($item->product->allow_multiple || $item->product->stock <= 0)
            <span class="store-order-item__quantity">
                {{ trans_choice('common.count.item', $item->quantity) }}
            </span>
        @else
            <div class="form-select">
                {!! Form::select(
                    "item[quantity]",
                    product_quantity_options($item->product, $item->quantity),
                    $item->quantity,
                    ['class' => 'form-select__input js-auto-submit']
                ) !!}
            </div>
        @endif
    </div>

    <span class="store-order-item__subtotal">{{ currency($item->subtotal()) }}</span>

    <span class="store-order-item__delete">
        <button
            type="submit"
            class="btn-osu-big btn-osu-big--store-cart-delete"
            name="item[quantity]"
            value="0"
        >
            <i class="fas fa-times"></i>
        </button>
    </span>

    @if (isset($itemErrors[$item->id]))
        <ul class="store-order-item__errors">
            @foreach ($itemErrors[$item->id] as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
{!! Form::close() !!}
