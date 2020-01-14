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
@extends('store/layout')


@section('content')
    @include('store.header')

    <div class="osu-page osu-page--generic">
        <div class="store-orders">
            @if (count($orders) === 0)
                <span>{{ trans('store.order.no_orders') }}</span>
            @endif

            @foreach ($orders as $order)
                <div class="store-order store-order--status-{{ $order->status }}">
                    <div class="store-order__header">
                        <div class="store-order__header-left">
                            <div>
                                #{{ $order->getKey() }}
                            </div>
                            <div class="store-order__header-subtext">
                                {{ currency($order->getTotal()) }}
                            </div>
                        </div>

                        <div class="store-order__header-right">
                            <div class="store-order__status">
                                {{ trans("store.order.status.{$order->status}") }}
                            </div>

                            <div class="store-order__header-subtext">
                                @if ($order->paid_at !== null)
                                    {!! trans('store.order.paid_on', ['date' => timeago($order->paid_at)]) !!}
                                @endif
                            </div>
                        </div>
                    </div>

                    <ul class="store-order__items">
                        @foreach ($order->items as $item)
                            <li>
                                <span>{{ $item->getDisplayName() }}</span>
                                <span class="store-order__item-quantity">x{{ $item->quantity }}</span>
                        @endforeach
                    </ul>
                    @if ($order->isShopify())
                        <button
                            class="js-store-resume-checkout btn-osu-big btn-osu-big--rounded-thin"
                            data-order-id="{{ $order->getKey() }}"
                            data-provider="{{ $order->getPaymentProvider() }}"
                            data-provider-reference="{{ $order->getProviderReference() }}"
                        >
                            {{ $order->status === 'processing' ? trans('store.order.resume') : trans('store.order.invoice') }}
                        </button>
                    @elseif ($order->hasInvoice())
                        <button
                            class="js-store-resume-checkout btn-osu-big btn-osu-big--rounded-thin"
                            data-order-id="{{ $order->getKey() }}"
                            data-provider="{{ $order->getPaymentProvider() }}"
                        >
                            {{ trans('store.order.invoice') }}
                        </button>
                    @endif
                </div>
            @endforeach

            @include('objects._pagination_v2', ['object' => $orders, 'modifiers' => ['light-bg']])
        </div>
    </div>
@endsection
