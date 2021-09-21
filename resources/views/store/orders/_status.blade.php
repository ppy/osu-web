{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="store-page">
    <h3 class="store-text store-text--title">Order Status</h3>

    @if ($order->isDelivered())
        <p><em class="store-text store-text--emphasis">Your order has been delivered! We hope you are enjoying it!</em></p>
        <p>
            If you have any issues with your purchase, please contact the <a href='mailto:osustore@ppy.sh'>osu!store support</a>.
        </p>
    @elseif ($order->isProcessing())
        <p><em class="store-text store-text--emphasis">{{ osu_trans('store.invoice.status.processing.title') }}</em></p>
        <p>
            {{ osu_trans('store.invoice.status.processing.line_1') }}
        </p>
        <p>
            {!! osu_trans('store.invoice.status.processing.line_2._', [
                'link' => Html::link(route('store.checkout.show', $order), osu_trans('store.invoice.status.processing.line_2.link_text')),
            ]) !!}
        </p>
    @elseif ($order->isCancelled())
        <p><em class="store-text store-text--emphasis">Your order has been cancelled</em></p>
        <p>
            If you didn't request a cancellation please contact <a href='mailto:osustore@ppy.sh'>osu!store support</a> quoting your order number (#{{$order->order_id}}).
        </p>
    @elseif (($order->isShipped() && ($order->last_tracking_state || count($order->trackingCodes()) === 0)) || $order->isDelivered())
        <p><em class="store-text store-text--emphasis">Your order has been shipped!</em></p>
        @if(count($order->trackingCodes()))
            <p>
                Tracking details follow:
            </p>
        @else
            <p>
                We don't have tracking details as we sent your package via Air Mail, but you can expect to receive it within 1-3 weeks. For Europe, sometimes customs can delay the order out of our control. If you have any concerns, please reply to the order confirmation email you received (or <a href='mailto:osustore@ppy.sh'>send us an email</a>).
            </p>
        @endif
    @else
        <p><em class="store-text store-text--emphasis">Your order is being prepared!</em></p>
        @if ($order->requiresShipping())
            <p>
                Please wait a bit longer for it to be shipped. Tracking information will appear here once the order has been processed and sent. This can take up to 5 days (but usually less!) depending on how busy we are.
            </p>

            <p>
                We send all orders from Japan using a variety of shipping services depending on the weight and value. This area will update with specifics once we have shipped the order.
            </p>
        @endif

        @if ($order->isPendingEcheck())
            <p>
                {{ osu_trans('store.invoice.echeck_delay') }}
            </p>
        @endif
    @endif
</div>
