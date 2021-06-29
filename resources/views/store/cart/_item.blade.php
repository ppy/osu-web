{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
        {{ $item->getDisplayName(true) }}
    </span>

    <div class="store-order-item__quantity">
    {{-- anything where stock is null either allows multiple or is max_quantity 1--}}
        @if($item->product->allow_multiple || $item->product->stock <= 0)
            <span class="store-order-item__quantity">
                {{ osu_trans_choice('common.count.item', $item->quantity) }}
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
