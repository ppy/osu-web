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

{!! trans('common.email.hello', ['user' => $order->user->username]) !!}

{!! trans('store.mail.payment_completed.content.thank_you') !!}

@foreach ($order->items as $item)
{!! i18n_number_format($item->quantity) !!} x {!! $item->getDisplayName() !!} ({!! currency($item->subtotal()) !!})
@endforeach

@if ($order->shipping > 0)
{!! trans('store.mail.payment_completed.content.shipping') !!} ({{ currency($order->shipping) }})
@endif
{!! trans('store.mail.payment_completed.content.total') !!} ({{ currency($order->getTotal()) }})

@if ($order->requiresShipping())
{!! trans('store.mail.payment_completed.content.prepare_shipping') !!}
@else
{!! trans('store.mail.payment_completed.content.processing') !!}
@endif
{!! route('store.invoice.show', $order) !!}

{!! trans('store.mail.payment_completed.content.questions') !!}

{!! trans('common.email.closing') !!}
The osu!store team
