{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout', ['titlePrepend' => osu_trans('layout.header.store.orders')])

@section('content')
    @include('store.header')

    <div class="osu-page osu-page--generic">
        <div class="store-orders">
            @if (count($orders) === 0)
                <span>{{ osu_trans('store.order.no_orders') }}</span>
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
                                {{ osu_trans("store.order.status.{$order->status}") }}
                            </div>

                            <div class="store-order__header-subtext">
                                @if ($order->paid_at !== null)
                                    {!! osu_trans('store.order.paid_on', ['date' => timeago($order->paid_at)]) !!}
                                @endif
                            </div>
                        </div>
                    </div>

                    <ul class="store-order__items">
                        @foreach ($order->items as $item)
                            <li>
                                <span>{{ $item->getDisplayName(true) }}</span>
                                <span class="store-order__item-quantity">x{{ $item->quantity }}</span>
                        @endforeach
                    </ul>
                    @if ($order->isShopify())
                        <button
                            class="js-store-resume-checkout btn-osu-big btn-osu-big--rounded-thin"
                            data-order-id="{{ $order->getKey() }}"
                            data-provider="{{ $order->getPaymentProvider() }}"
                            data-provider-reference="{{ $order->getProviderReference() }}"
                            data-status="{{ $order->status }}"
                        >
                            {{ $order->status === 'processing' ? osu_trans('store.order.resume') : osu_trans('store.order.invoice') }}
                        </button>
                    @elseif ($order->hasInvoice())
                        <button
                            class="js-store-resume-checkout btn-osu-big btn-osu-big--rounded-thin"
                            data-order-id="{{ $order->getKey() }}"
                            data-provider="{{ $order->getPaymentProvider() }}"
                            data-status="{{ $order->status }}"
                        >
                            {{ osu_trans('store.order.invoice') }}
                        </button>
                    @endif

                    @if ($order->canUserCancel())
                        <button
                            class="btn-osu-big btn-osu-big--rounded-thin btn-osu-big--danger"
                            data-confirm="{{ osu_trans('store.order.cancel_confirm') }}"
                            data-method="DELETE"
                            data-url="{{ route('store.orders.destroy', $order) }}"
                            data-reload-on-success="1"
                            data-remote="1"
                        >
                            {{ osu_trans('store.order.cancel') }}
                        </button>
                    @endif
                </div>
            @endforeach

            @include('objects._pagination_v2', ['object' => $orders])
        </div>
    </div>
@endsection
