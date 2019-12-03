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

{!! trans('mail.common.hello', ['user' => $order->user->username]) !!}

{!! trans('mail.store_payment_completed.thank_you') !!}

@foreach ($order->items as $item)
{!! i18n_number_format($item->quantity) !!} x {!! $item->getDisplayName() !!} ({!! currency($item->subtotal()) !!})
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
