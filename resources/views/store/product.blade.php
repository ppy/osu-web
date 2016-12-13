{{--
    Copyright 2015 ppy Pty. Ltd.

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
    @include("store.header")

    {!! Form::open([
        "url" => "store/add-to-cart",
        "data-remote" => true,
        "id" => "product-form",
        "class" => "osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1"
    ]) !!}
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1" id="product-header" style="background-image: url({{ $product->header_image }})">
            <div>{!! Markdown::convertToHtml($product->header_description) !!}</div>
        </div>

        <div class="osu-layout__sub-row">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $product->name }}</h1>
                </div>
            </div>

            @if($product->custom_class && View::exists("store.products.{$product->custom_class}"))

                <div class="row">
                    <div class="col-md-12">
                        {!! Markdown::convertToHtml($product->description) !!}
                    </div>
                </div>

                @include("store.products.{$product->custom_class}")

            @else
            <div class="row">
                <div class="col-md-6">
                    <div class="gallery-previews">
                        @foreach($product->images() as $i => $image)
                            <?php $imageSize = fast_imagesize($image[1]); ?>
                            <a
                                class="gallery-previews__item js-gallery"
                                data-width="{{ $imageSize[0] }}"
                                data-height="{{ $imageSize[1] }}"
                                data-gallery-id="product-{{ $product->product_id }}"
                                data-index="{{ $i }}"
                                href="{{ $image[1] }}"
                                style="background-image: url('{{ $image[1] }}');"
                                data-visibility="{{ $loop->first ? '' : 'hidden' }}"
                            ></a>
                        @endforeach
                    </div>
                    <div class="gallery-thumbnails">
                        @foreach($product->images() as $i => $image)
                            <a
                                href="#"
                                style="background-image: url('{{ $image[0] }}');"
                                class="
                                    gallery-thumbnails__item
                                    js-gallery-thumbnail
                                    {{ $loop->first ? 'js-gallery-thumbnail--active' : '' }}
                                "
                                data-gallery-id="product-{{ $product->product_id }}"
                                data-index="{{ $i }}"
                            ></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Markdown::convertToHtml($product->description) !!}
                        </div>
                    </div>
                    <div class="row price-box">
                        <div class="col-md-12">
                            <p class="price">{{ currency($product->cost) }}</p>
                            <p class="notes">excluding shipping fees</p>
                        </div>
                    </div>

                    @if($product->types())
                    @foreach($product->types() as $type => $values)
                    <div class="form-group">
                        <label for="select-product-{{ $type }}">{{ $type }}</label>

                        <select id="select-product-{{ $type }}" class="form-control js-url-selector" data-keep-scroll="1">
                            @foreach($values as $value => $product_id)
                            <option {{ $product_id === $product->product_id ? "selected" : "" }} value="{{ action("StoreController@getProduct", $product_id) }}">
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach
                    @endif

                    @if($product->inStock())
                    <div class="row">
                        <div class="col-md-12">
                            <div class='form-group'>
                                <input type="hidden" name="item[product_id]" value="{{ $product->product_id }}" />
                                {!! Form::label('item[quantity]', 'Quantity') !!}
                                {!! Form::select("item[quantity]", product_quantity_options($product), 1, ['class' => 'js-store-item-quantity form-control']) !!}
                            </div>
                        </div>
                    </div>
                    @elseif($product->inStock(1, true))
                    <div class="row">
                        <div class="col-md-12">
                            {{ trans('store.product.stock.out_with_alternative') }}
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            {{ trans('store.product.stock.out') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="osu-layout__sub-row osu-layout__sub-row--with-separator" id="add-to-cart">
            <div class="big-button">
                @if($product->inStock())
                    <button type="submit" class="js-store-add-to-cart btn-osu btn-osu-default">
                        {{ trans('store.product.add_to_cart') }}
                    </button>

                @elseif(!$requestedNotification)
                    <a class="btn-osu btn-osu-default" href="{{ route('store.request-notification', ['product_id' => $product->product_id, 'create']) }}" data-remote="true" data-method="put">
                        {{ trans('store.product.notify') }}
                    </a>
                @endif
            </div>

            @if($requestedNotification && !$product->inStock())
                <div class="store-notification-requested-alert">
                    <span class="fa fa-check-circle-o store-notification-requested-alert__icon"></span>
                    <p class="store-notification-requested-alert__text">{!! trans('store.product.notification_success', ['link' => link_to_route('store.request-notification', trans('store.product.notification_remove_text'), ['product_id' => $product->product_id, 'delete'], ['data-remote' => 'true', 'data-method' => 'put'])]) !!}</p>
                </div>
            @endif
        </div>

    {!! Form::close() !!}
@endsection
