{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
