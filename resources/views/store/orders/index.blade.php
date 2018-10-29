{{--
    Copyright 2015-2018 ppy Pty. Ltd.

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
@extends('master')


@section('content')
    @include('store.header')

    <div class="osu-layout__row osu-layout__row--page">
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
                    @if ($order->hasInvoice())
                        <a class="store-order__link" href="{{ route('store.invoice.show', $order) }}">{{ trans('store.order.invoice') }}</a>
                    @endif
                </div>
            @endforeach

            @include('objects._pagination_v0', ['object' => $orders])
        </div>
    </div>
@endsection
