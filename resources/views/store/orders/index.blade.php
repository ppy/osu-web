{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout')


@section('content')
    @include('store.header')

    <div class="osu-layout__row osu-layout__row--page osu-layout--store">
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
                            class="js-store-resume-checkout btn-osu-big"
                            data-order-id="{{ $order->getKey() }}"
                            data-provider="{{ $order->getPaymentProvider() }}"
                            data-provider-reference="{{ $order->getProviderReference() }}"
                        >
                            {{ $order->status === 'processing' ? trans('store.order.resume') : trans('store.order.invoice') }}
                        </button>
                    @elseif ($order->hasInvoice())
                        <button
                            class="js-store-resume-checkout btn-osu-big"
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
