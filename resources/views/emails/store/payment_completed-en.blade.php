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

Hi {{ $order->user->username }},

Thanks for your osu!store order!

@foreach ($order->items as $item)
{{ $item->quantity }} x {{ $item->getDisplayName() }} ({{ currency($item->subtotal()) }})
@endforeach

@if ($order->shipping > 0)
Shipping ({{ currency($order->shipping) }})
@endif
Total ({{ currency($order->getTotal()) }})

@if ($order->requiresShipping())
We have received your payment and are preparing your order for shipping. It may take a few days for us to send it out, depending on the quantity of orders. You can follow the progress of your order at {{ route('store.invoice.show', $order) }}, including tracking details where available.
@else
We have received your payment and are currently processing your order. You can follow the progress of your order at {{ route('store.invoice.show', $order) }}.
@endif

If you have any questions, don't hesitate to reply to this email.

Regards,
The osu!store team
