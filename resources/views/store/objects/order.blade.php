{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $itemErrors = $validationErrors['orderItems'] ?? [];

    $checkout = $checkout ?? true;
    $forShipping = $forShipping ?? false;

    $modifiers = $modifiers ?? [];
    $extraClasses = presence($extraClasses ?? null);
@endphp

<ul class="{{ class_with_modifiers('order-line-items', $modifiers) }} {{ $extraClasses }}">
    @foreach ($order->items as $i)
        @if (!$forShipping || $i->product->requiresShipping())
            <li class="order-line-items__item order-line-items__item--main">
                <div class="order-line-items__data order-line-items__data--name">
                    {{ $i->getDisplayName(true) }}

                    @if (isset($itemErrors[$i->id]))
                        <ul class="order-line-items__errors">
                            @foreach ($itemErrors[$i->id] as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
                @if (isset($weight))
                    <div class="order-line-items__data order-line-items__data--weight">
                        @if ($i->product->weight !== null)
                            {{ $i->product->weight }}g
                        @endif
                    </div>
                @endif
                <div class="order-line-items__data order-line-items__data--quantity">
                    {{ trans_choice('common.count.item', $i->quantity) }}
                </div>
                <div class="order-line-items__data order-line-items__data--value">
                    {{ currency($i->subtotal()) }}
                </td>
            </li>
        @endif
    @endforeach

    @if ($checkout && $order->shipping > 0)
        <li class="order-line-items__item order-line-items__item--footer">
            <div class="order-line-items__data order-line-items__data--name">
                Subtotal
            </div>
            <div class="order-line-items__data order-line-items__data--value">
                {{ currency($order->getSubtotal()) }}
            </div>
        </li>

        <li class="order-line-items__item order-line-items__item--footer">
            <div class="order-line-items__data order-line-items__data--name">
                Shipping &amp; Handling
            </div>
            <div class="order-line-items__data order-line-items__data--value">
                {{ currency($order->shipping) }}
            </div>
        </li>
    @endif

    @if (!$checkout)
        <li class="order-line-items__item order-line-items__item--footer order-line-items__item--footer-total">
            <div class="order-line-items__data order-line-items__data--name">
                Total
            </div>
            <div class="order-line-items__data order-line-items__data--value">
                {{ currency($order->getSubtotal($forShipping)) }}
            </div>
        </li>
    @endif
</ul>
