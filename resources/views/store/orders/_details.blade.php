{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="store-page">
    <div class="store-page__invoice-header">
        <div>
            <h1 class="store-text store-text--title">Invoice</h1>
            <div>
                Date:
                @if($order->shipped_at)
                    {{ $order->shipped_at->toDateString() }}
                @elseif($order->paid_at)
                    {{ $order->paid_at->toDateString() }}
                @else
                    {{ $order->updated_at->toDateString() }}
                @endif
            </div>
        </div>
        <div>
            <p>
                <em class="store-text store-text--emphasis">ppy Pty Ltd</em><br />
                ACN 163 593 413 a.t.f. Dean Herbert Family Trust
            </p>

            <p>contact: pe@ppy.sh / +81 80 1381 1430</p>
        </div>
    </div>

    <hr />

    @if($order->address !== null)
        <div class="store-page__address">
            <div>
                <h4 class="store-text store-text--title store-text--title-small">Sent Via:</h4>

                <div class='address'>
                    osu!store
                </div>
            </div>

            <div>
                <h4 class="store-text store-text--title store-text--title-small">Shipping To:</h4>

                @include('store.objects.address', ['data' => $order->address])
            </div>
        </div>
    @endif

    <div class="store-page__order-details">
        <h3 class="store-text store-text--title">Order Details</h3>

        @include('store.objects.order', [
            'order' => $order,
            'weight' => true,
            'checkout' => false,
        ])

        @if ($order->isHideSupporterFromActivity())
            {{ osu_trans('store.invoice.hide_from_activity') }}
        @endif
    </div>

    @if ($order->address !== null)
        @php
            $showTrackingCode = ($order->isShipped() || $order->isDelivered() || Auth::user()->isAdmin()) && $order->tracking_code;

            $transactionDetails = [
                'Salesperson' => 'osu!store',
                'Order #' => "#{$order->order_id}",
                'Shipping Method' => $showTrackingCode ? 'EMS ('.trim($order->tracking_code).')' : 'N/A',
                'Shipping Terms' => 'FOB Japan',
                'Payment Terms' => studly_case($order->getPaymentProvider()).' ('.$order->getPaymentStatusText().')',
            ];
        @endphp
        <dl class="store-transaction-info">
            @foreach ($transactionDetails as $key => $value)
                <dt class="store-transaction-info__entry store-transaction-info__entry--term">
                    {{ $key }}
                </dt>
                <dd class="store-transaction-info__entry">
                    {{ $value }}
                </dd>
            @endforeach
        </dl>
    @endif
</div>
