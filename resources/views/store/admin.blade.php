{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, version 3 of the License.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")

<style>
.product_1 { background-color: #F7CCFF; }
.product_2, .product_4 { background-color: #D3FEB8; }
.product_5, .product_6, .product_7, .product_8 { background-color: #FCDD2C; }
.product_12, .product_13, .product_14, .product_15, .product_16, .product_17, .product_18, .product_19 { background-color: #BDFF5E; }
.product_33, .product_34, .product_35, .product_36 { background-color: #54F35B; }

</style>

<div class="row-page">
    <div class="col-md-12">
        <h1>Store Admin <small>{!! count($orders) !!} orders waiting to be shipped!</small></h1>
    </div>

    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans("store.admin.warehouse") }}</h3>
            </div>

            <table class="table table-striped">
                <thead>
                    <th>{{ trans("store.product.name") }}</th>
                    <th>{{ trans("store.order.item.quantity") }}</th>
                </thead>
                <tbody>
                    @foreach ($ordersItemsQuantities as $ordersItemsQuantity)
                        <tr>
                            <td>{{ $ordersItemsQuantity->name }}</td>
                            <td>{{ $ordersItemsQuantity->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($orders as $o)
    {!! Form::open(["url" => "store/admin", "data-remote" => true]) !!}
    {!! Form::hidden('id', $o->order_id) !!}
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Order #{{ $o->order_id }} for
                <small>
                    {{ $o->user ? $o->user->username : '-' }} ({{ $o->user->user_email }})
                    <a href='/store/invoice/{{ $o->order_id }}'>invoice</a>
                    <a href='/store/invoice/{{ $o->order_id }}?copies=2' target='_blank'>(print)</a>
                </small>
                </h3>
            </div>
            <div class="panel-body">
                <div class='row'>
                    <div class='col-md-8'>
                        <div class="form-group">
                        @if ($o->status === 'paid' || $o->status === 'shipped')
                            {!! Form::label('order[status]', 'Status') !!}
                            {!! Form::select('order[status]', ['paid' => 'Paid', 'shipped' => 'Shipped'], $o->status, ['class' => 'js-auto-submit form-control']) !!}
                        @else
                            <h1 style='text-transform: uppercase;'>{{ $o->status }}</h1>
                        @endif
                        </div>

                        <div class="form-group">
                        {!! Form::label('order[tracking_code]', 'Tracking/Notes') !!}
                        @if ($o->tracking_code)
                        <a target="_blank" href="https://trackings.post.japanpost.jp/services/srv/search/direct?searchKind=S004&locale=en&reqCodeNo1={!! $o->tracking_code !!}">lookup</a>
                        @endif

                        {!! Form::text('order[tracking_code]', $o->tracking_code, ['class' => 'js-auto-submit form-control']) !!}

                        </div>
                    </div>

                    @include('store.objects.address', ['data' => $o->address])
                </div>
            </div>

            <table class='table order-line-items {{ $table_class or "table-striped" }}'>
                <tbody>
                    @foreach($o->items as $i)
                    <tr>
                        <td class="product_{{ $i->product_id }}">
                            @if ($i->quantity > 1)
                                <strong>{{ $i->quantity }} x {{ $i->getDisplayName() }}</strong>
                            @else
                                {{ $i->quantity }} x {{ $i->getDisplayName() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! Form::close() !!}
    @endforeach
</div>
@stop
