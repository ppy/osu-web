{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
@extends("master")

@section("content")

<style>
.product_1 { background-color: #F7CCFF; }
.product_2, .product_4 { background-color: #D3FEB8; }
.product_5, .product_6, .product_7, .product_8 { background-color: #FCDD2C; }
.product_12, .product_13, .product_14, .product_15, .product_16, .product_17, .product_18, .product_19 { background-color: #BDFF5E; }

.product_20, .product_21, .product_22, .product_23, .product_24, .product_25, .product_26, .product_27, .product_28, .product_29, .product_30, .product_31 { background-color: #e88cb8; }

.product_33, .product_34, .product_35, .product_36 { background-color: #54F35B; }

.product_name_expanded {
    width: 80%;
    display: inline-block;
}

.product_name_expanded select {
    background: transparent;
}

.content-editable-submit {
    border-bottom: dashed 1px #d7dce6;
    display: inline-block;
    min-width: 10px;
}

.content-editable-submit:focus {
    background: #dddddd;
}

.bold { font-weight: bold; }

</style>

<div class="osu-layout__row osu-layout__row--page">
    <div>
        <h1>Store Admin <small>{!! count($orders) !!} orders waiting to be shipped!</small></h1>
    </div>

    <div>
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
                            <td><a href='?product={{ $ordersItemsQuantity->product_id }}'>{{ $ordersItemsQuantity->name }}</a></td>
                            <td>{{ $ordersItemsQuantity->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($orders as $o)
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Order #{{ $o->order_id }} for
                <small>
                    @if ($o->user !== null)
                        {{ $o->user->username }} ({{ $o->user->user_email }})
                    @else
                        -
                    @endif
                    <a href="{{ route('store.invoice.show', ['invoice' => $o->getKey(), 'for_shipping' => 1]) }}">invoice</a>
                    <a href="{{ route('store.invoice.show', ['invoice' => $o->getKey(), 'for_shipping' => 1, 'copies' => 2]) }}" target="_blank">(print)</a>
                </small>
                </h3>
            </div>
            <div class="panel-body">
                <div class="grid grid--gutters">
                    <div class="grid-cell grid-cell--2of3">
                        {!! Form::open(['route' => ['admin.store.orders.update', $o->order_id], 'method' => 'put', 'data-remote' => true]) !!}
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
                        {!! Form::close() !!}
                    </div>
                    @if ($o->address)
                        @include('store.objects.address_editable', ['data' => $o->address, 'modifiable' => true])
                    @endif
                </div>
            </div>

            <table class='table order-line-items {{ $table_class or "table-striped" }}'>
                <tbody>
                    @foreach($o->items()->hasShipping()->with('product')->get() as $i)
                    <tr>
                        <td class="product_{{ $i->product_id }} {{ $i->quantity > 1 ? "bold" : "" }}">
                            {!! Form::open(['route' => ['admin.store.orders.items.update', $o->order_id, $i->id], 'method' => 'put', 'data-remote' => true]) !!}
                            <span class="content-editable-submit" contenteditable="true" data-name="item[quantity]">{{{ $i->quantity }}}</span>
                            x
                            <span class="product_name_expanded">
                            @if ($i->product->typeMappings())
                                <select id="select-item" name="item[product_id]" class="form-control js-auto-submit">
                                    @foreach($i->product->productsInRange() as $r)
                                    <option
                                        {{ $i->product_id == $r->product_id ? "selected" : "" }}
                                        {{ !$r->inStock($i->quantity) ? "disabled" : "" }}
                                        value="{{ $r->product_id }}">
                                        {{ $r->name }}
                                        @if (!$r->inStock($i->quantity))
                                            --OUT OF STOCK--
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            @else
                                {{ $i->getDisplayName() }}
                            @endif
                            </span>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

<div class="osu-layout__row osu-layout__row--page">
    {!! Form::open(['route' => 'admin.store.orders.ship', 'method' => 'post', 'data-remote' => true]) !!}
    <div class="big-button">
        <button type="submit" class="btn-osu btn-osu-danger">Ship all tracked orders</button>
    </div>
    {!! Form::close() !!}
</div>
@stop
