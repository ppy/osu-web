{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="grid grid--gutters store-page">
    <div class="grid-cell grid-cell--fill">
        <div class="grid grid--xs">
            <div class="grid-cell">
                <div>
                    <h1 class="store-text store-text--title">Invoice</h1>
                </div>
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
            <div class="grid-cell grid-cell--minimum">
                <p>
                    <em class="store-text store-text--emphasis">ppy Pty Ltd</em><br />
                    ACN 163 593 413 a.t.f. Dean Herbert Family Trust
                </p>

                <p>contact: pe@ppy.sh / +81 80 1381 1430</p>
            </div>
        </div>

        <hr />

        @if($order->address !== null)
            <div class="grid grid--xs">
                <div class="grid-cell grid-cell--1of3">
                    <h4 class="store-text store-text--title store-text--title-small">Sent Via:</h4>

                    @include('store.objects.address', ['data' => $sentViaAddress, 'grid' => ''])
                </div>

                <div class="grid-cell grid-cell--1of3">
                </div>

                <div class="grid-cell grid-cell--1of3">
                    <h4 class="store-text store-text--title store-text--title-small">Shipping To:</h4>

                    @include('store.objects.address', ['data' => $order->address, 'grid' => ''])
                </div>
            </div>
        @endif

        <div class="grid">
            <div class="grid-cell">
                <h3 class="store-text store-text--title">Order Details</h3>
            </div>
        </div>

        <div class="grid">
            <div class="grid-cell">
                @include('store.objects.order', [
                    'order' => $order,
                    'weight' => true,
                    'checkout' => false,
                    'forShipping' => $forShipping,
                ])
            </div>
        </div>

        @if ($order->address !== null)
            @php
                $showTrackingCode = ($order->isShipped() || $order->isDelivered() || Auth::user()->isAdmin()) && $order->tracking_code;

                $transactionDetails = [
                    'Salesperson' => "{$sentViaAddress->first_name} {$sentViaAddress->last_name}",
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
</div>
