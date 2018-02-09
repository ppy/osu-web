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
@php
    $itemErrors = $validationErrors['orderItems'] ?? [];
    if (!isset($checkout)) {
        $checkout = true;
    }

    if (!isset($forShipping)) {
        $forShipping = false;
    }
@endphp

<table class='table order-line-items {{ $table_class or "table-striped" }}'>
    <tbody>
        @foreach ($order->items as $i)
            @if (!$forShipping || $i->product->requiresShipping())
                <tr>
                    <td>
                        {{ $i->getDisplayName() }}

                        @if (isset($itemErrors[$i->id]))
                            <ul class="store-order-item__errors">
                                @foreach ($itemErrors[$i->id] as $message)
                                    <li class="store-order-item__error">{!! $message !!}
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
