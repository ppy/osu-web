{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\Store\Order;

    $echeckStatus = match ($order->tracking_code) {
        Order::ECHECK_DENIED => 'echeck_denied',
        Order::PENDING_ECHECK => 'echeck_delay',
        default => null,
    };
@endphp

<div class="store-page">
    <h3 class="store-text store-text--title">{{ osu_trans('store.order.status.title') }}</h3>

    @if ($order->isDelivered())
        <p><em class="store-text store-text--emphasis">{{ osu_trans('store.invoice.status.delivered.title') }}</em></p>
        <p>
            {!! osu_trans('store.invoice.status.delivered.line_1._', [
                'link' => link_to('mailto:osustore@ppy.sh', osu_trans('store.invoice.status.delivered.line_1.link_text')),
            ]) !!}
        </p>
    @elseif ($order->isPaymentRequested())
        <p><em class="store-text store-text--emphasis">{{ osu_trans('store.invoice.status.processing.title') }}</em></p>
        <p>
            {{ osu_trans('store.invoice.status.processing.line_1') }}
        </p>
        <p>
            {!! osu_trans('store.invoice.status.processing.line_2._', ['link' => link_to(
                route('store.checkout.show', $order->getKey()),
                osu_trans('store.invoice.status.processing.line_2.link_text'),
            )]) !!}
        </p>
    @elseif ($order->isCancelled())
        <p><em class="store-text store-text--emphasis">{{ osu_trans('store.invoice.status.cancelled.title') }}</em></p>
        <p>
            {!! osu_trans('store.invoice.status.cancelled.line_1._', [
                'link' => link_to('mailto:osustore@ppy.sh', osu_trans('store.invoice.status.cancelled.line_1.link_text')),
                'order_number' => $order->order_id,
            ]) !!}
        </p>
    @elseif (($order->isShipped() && ($order->last_tracking_state || count($order->trackingCodes()) === 0)) || $order->isDelivered())
        <p><em class="store-text store-text--emphasis">{{ osu_trans('store.invoice.status.shipped.title') }}</em></p>
        @if(count($order->trackingCodes()))
            <p>
                {{ osu_trans('store.invoice.status.shipped.tracking_details') }}
            </p>
        @else
            <p>
                {!! osu_trans('store.invoice.status.shipped.no_tracking_details._', [
                    'link' => link_to('mailto:osustore@ppy.sh', osu_trans('store.invoice.status.shipped.no_tracking_details.link_text')),
                ]) !!}
            </p>
        @endif
    @else
        <p><em class="store-text store-text--emphasis">{{ osu_trans('store.invoice.status.prepared.title') }}</em></p>
        @if ($order->requiresShipping())
            <p>
                {{ osu_trans('store.invoice.status.prepared.line_1') }}
            </p>

            <p>
                {{ osu_trans('store.invoice.status.prepared.line_2') }}
            </p>
        @endif

        @if ($echeckStatus !== null)
            <p>
                {{ osu_trans("store.invoice.{$echeckStatus}") }}
            </p>
        @endif
    @endif
</div>
