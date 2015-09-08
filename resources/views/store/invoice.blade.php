{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")
@include("store.header")
<style>
.address {
	border: none;
	box-shadow: none;
	background-color: #fff;
	padding-left: 0px;
	padding-right: 0px;
}
</style>

@if(!$order)
<div class="row-page">
	<div class="col-md-12">
		<h1>Not Found</h1>
		<p>The requested order could not be found.</p>
	</div>
</div>
@else
@if(Input::has("thanks"))
<div class="row-page noprint">
	<div class="col-xs-12">
		<h1>Thanks for your order!</h1>
		<p>
			You will receive a confirmation email soon. If you have any enquiries, please <a href='mailto:osustore@ppy.sh'>contact us</a>!
		</p>
	</div>
</div>
@endif

@for ($i = 0; $i < $copies; $i++)
	@if($i > 0)
	<div class='print-page-break'></div>
	@endif
	<div class="row-page invoice-page"><div class="col-md-12">
		<div class="row">
			<div class="col-xs-5">
				<div>
					<h1>Invoice</h1>
				</div>
				<div>
					Date:
					@if($order->shipped_at)
						{{{ $order->shipped_at->toDateString() }}}
					@elseif($order->paid_at)
						{{{ $order->paid_at->toDateString() }}}
					@else
						{{{ $order->updated_at->toDateString() }}}
					@endif
				</div>
			</div>
			<div class="col-xs-7 shipper-info">
				<strong>ppy Pty Ltd</strong>
				<p>ACN 163 593 413 a.t.f. Dean Herbert Family Trust</p>
				<p>contact: pe@ppy.sh / +81 80 1381 1430</p>
			</div>
		</div>

		<hr />

		@if($order->address !== null)
		<div class="row">
			<div class="col-xs-4">
				<h4>Sent Via:</h4>
				@include('store.objects.address', ['data' => $sentViaAddress, 'grid' => ''])
			</div>
			<div class="col-xs-4">
			</div>
			<div class="col-xs-4">
				<h4>Shipping To:</h4>
				@include('store.objects.address', ['data' => $order->address, 'grid' => ''])
			</div>
		</div>
		@endif

		<div class="row">
			<div class="col-xs-12">
				<h3>Order Details</h3>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				@include("store.objects.order", ['order' => $order, 'weight' => true, 'shipping' => false])
			</div>
		</div>

		@if($order->address !== null)
		<table class='table table-striped transaction-info'>
			<tr>
				<th>Salesperson</th>
				<th>Order #</th>
				<th>Shipping Method</th>
				<th>Shipping Terms</th>
				<th>Payment Terms</th>
			</tr>
			<tr>
				<td>{{{ $sentViaAddress->first_name }}} {{{ $sentViaAddress->last_name }}}</td>
				<td>#{{{ $order->order_id }}}</td>
				<td>EMS
				@if($order->tracking_code)
					({{ $order->tracking_code }})
				@endif
				</td>
				<td>FOB Japan</td>
				<td>Paypal (paid)</td>
			</tr>
		</table>
		@endif

	</div></div>
@endfor

@if($copies > 1)
<script>
window.onload = function() {
	setTimeout(function() {
		window.print();
		setTimeout(function() {
			window.close();
		}, 2000);
	}, 2000);
}
</script>
@endif

<div class="row-page no-print">
    <div class="col-xs-12">
        <h3>Order Status</h3>
    </div>
    <div class="col-xs-12">
    	@if ($order->status == 'delivered')
	    	<p><strong>Your order has been delivered! We hope you are enjoying it!</strong></p>
	    	<p>
	    	    If you have any issues with your purchase, please contact the <a href='mailto:osustore@ppy.sh'>osu!store support</a>.
	    	</p>
    	@elseif ($order->status == 'incart')
			<p><strong>Your payment has not yet been confirmed!</strong></p>
			<p>
			    If you have already paid, we may still be waiting to receive confirmation of your payment. Please refresh this page in a minute or two!
			</p>
    	@elseif ($order->status == 'cancelled')
    		<p><strong>Your order has been cancelled</strong></p>
    		<p>
    		    If you didn't request a cancellation please contact <a href='mailto:osustore@ppy.sh'>osu!store support</a> quoting your order number (#{{$order->order_id}}).
    		</p>
    	@elseif (($order->status == 'shipped' && ($order->last_tracking_state || !$order->tracking_code)) || $order->status == 'delivered')
            @if($order->tracking_code)
                <iframe src="https://trackings.post.japanpost.jp/services/srv/search/direct?searchKind=S004&locale=en&reqCodeNo1={{ $order->tracking_code }}" frameBorder="0" width="100%" height="600px">
                </iframe>
            @else
                <div>
                    <p><strong>Your order has been shipped!</strong></p>
                    <p>
                        We don't have tracking details as it was send in a small envelope, but you can expect to receive it within 1-2 weeks at the most. If you have any concerns, please reply to the order confirmation email you received (or <a href='mailto:osustore@ppy.sh'>send us an email</a>).
                    </p>
                </div>
            @endif
        @else
            <p><strong>Your order is being prepared!</strong></p>
            <p>
                Please wait a bit longer for it to be shipped. Tracking information will appear here once the order has been processed and sent. This can take up to 5 days (but usually less!) depending on how busy we are.
            </p>

			<p>
				We send all orders from Japan using EMS. This is the most efficient service available to us, and it should reach you in a very short time (3~14 days after we send it). For Europe, sometimes customs can delay the order out of our control.
			</p>
		@endif
	</div>
</div>
@endif

@stop
