{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

{!! trans('mail.common.hello', ['user' => $order->user->username]) !!}

{!! trans('mail.store_payment_completed.thank_you') !!}

@foreach ($order->items as $item)
{!! i18n_number_format($item->quantity) !!} x {!! $item->getDisplayName(false) !!} ({!! currency($item->subtotal()) !!})
@endforeach

@if ($order->shipping > 0)
{!! trans('mail.store_payment_completed.shipping') !!} ({{ currency($order->shipping) }})
@endif
{!! trans('mail.store_payment_completed.total') !!} ({{ currency($order->getTotal()) }})

@if ($order->requiresShipping())
{!! trans('mail.store_payment_completed.prepare_shipping') !!}
@else
{!! trans('mail.store_payment_completed.processing') !!}
@endif
{!! route('store.invoice.show', $order) !!}

{!! trans('mail.store_payment_completed.questions') !!}

{!! trans('mail.common.closing') !!}
The osu!store team
