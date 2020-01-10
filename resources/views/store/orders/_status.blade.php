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
<div class="store-page">
    <h3 class="store-text store-text--title">Order Status</h3>

    @if ($order->status === 'delivered')
        <p><em class="store-text store-text--emphasis">Your order has been delivered! We hope you are enjoying it!</em></p>
        <p>
            If you have any issues with your purchase, please contact the <a href='mailto:osustore@ppy.sh'>osu!store support</a>.
        </p>
    @elseif ($order->isProcessing())
        <p><em class="store-text store-text--emphasis">{{ trans('store.invoice.status.processing.title') }}</em></p>
        <p>
            {{ trans('store.invoice.status.processing.line_1') }}
        </p>
        <p>
            {!! trans('store.invoice.status.processing.line_2._', [
                'link' => Html::link(route('store.checkout.show', $order), trans('store.invoice.status.processing.line_2.link_text')),
            ]) !!}
        </p>
    @elseif ($order->status === 'cancelled')
        <p><em class="store-text store-text--emphasis">Your order has been cancelled</em></p>
        <p>
            If you didn't request a cancellation please contact <a href='mailto:osustore@ppy.sh'>osu!store support</a> quoting your order number (#{{$order->order_id}}).
        </p>
    @elseif (($order->status === 'shipped' && ($order->last_tracking_state || count($order->trackingCodes()) === 0)) || $order->status === 'delivered')
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
                {{ trans('store.invoice.echeck_delay') }}
            </p>
        @endif
    @endif
</div>
