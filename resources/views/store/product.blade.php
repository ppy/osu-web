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

    {!! Form::open(["url" => "store/add-to-cart", "data-remote" => true, "id" => "product-form", "class" => "row-page row-group"]) !!}
        <div class="row-subgroup row-subgroup--large" id="product-header" style="background-image: url({{ $product->header_image }})">
            <div>{!! Markdown::convertToHtml($product->header_description) !!}</div>
        </div>

        <div class="row-subgroup">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $product->name }}</h1>
                </div>
            </div>

            @if($product->custom_class)

                <div class="row">
                    <div class="col-md-12">
                        {!! Markdown::convertToHtml($product->description) !!}
                    </div>
                </div>

                @include("store.products.{$product->custom_class}")

            @else
            <div class="row">
                <div class="col-md-6">
                    @if($product->images())
                    <ul id="product-slides" class="rslides">
                        @foreach($product->images() as $i => $image)
                        <li>
                            <?php $imageSize = fast_imagesize($image[1]); ?>
                            <a
                                class="js-gallery"
                                data-width="{{ $imageSize[0] }}"
                                data-height="{{ $imageSize[1] }}"
                                data-gallery-id="product-{{ $product->product_id }}"
                                data-index="{{ $i }}"
                                href="{{ $image[1] }}"
                                style="background-image: url('{{ $image[1] }}');">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <ul id="product-slides-nav" class="rslides-nav">
                        @foreach($product->images() as $image)
                        <li>
                            <a href="#"><div style="background-image: url('{{ $image[0] }}');"></div></a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="preview" data-image="{{ $product->image }}" style="background-image: url('{{ $product->image }}');"></div>
                    @endif
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
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            Currently out of stock :(. Check back soon.
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        @if($product->inStock())
        <div class="row-subgroup js-store-add-to-cart" id="add-to-cart">
            <div class="big-button">
                <button type="submit" class="btn-osu btn-osu-default">Add to Cart</button>
            </div>
        </div>
        @endif

    {!! Form::close() !!}
@endsection
