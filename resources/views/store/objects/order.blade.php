{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $itemErrors = $validationErrors['orderItems'] ?? [];
    if (!isset($checkout)) {
        $checkout = true;
    }

    if (!isset($forShipping)) {
        $forShipping = false;
    }
@endphp

<table class='table order-line-items {{ $table_class ?? "table-striped" }}'>
    <tbody>
        @foreach ($order->items as $i)
            @if (!$forShipping || $i->product->requiresShipping())
                <tr>
                    <td>
                        {{ $i->getDisplayName() }}

                        @if (isset($itemErrors[$i->id]))
                            <ul class="store-order-item__errors">
                                @foreach ($itemErrors[$i->id] as $message)
                                    <li class="store-order-item__error">{{ $message }}
                                @endforeach
                            </ul>
                        @endif

                    </td>
                    @if (isset($weight))
                        @if ($i->product->weight !== null)
                            <td>{{ $i->product->weight }}g</td>
                        @else
                            <td></td>
                        @endif
                    @endif
                    <td>{{ trans_choice('common.count.item', $i->quantity) }}</td>
                    <td class="text-right">{{ currency($i->subtotal()) }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>

    <tfoot>
        @if ($checkout && $order->shipping > 0)
            <tr class="warning">
                <td>Subtotal</td>
                <td></td>
                @if (isset($weight))<td></td>@endif
                <td class="text-right">{{ currency($order->getSubtotal()) }}</td>
            </tr>
            <tr class="warning">
                <td>Shipping &amp; Handling</td>
                <td></td>
                @if (isset($weight))<td></td>@endif
                <td class="text-right">{{ currency($order->shipping) }}</td>
            </tr>
        @endif
        <tr class="warning total">
            <td>Total</td>
            <td></td>
            @if (isset($weight))<td></td>@endif
            @if ($checkout && $order->shipping > 0)
                <td class="text-right">{{ currency($order->getTotal()) }}</td>
            @else
                <td class="text-right">{{ currency($order->getSubtotal($forShipping)) }}</td>
            @endif
        </tr>
    </tfoot>
</table>
