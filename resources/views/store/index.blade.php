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

    <div class="osu-layout__row osu-layout__row--with-gutter product-listing">
        @foreach($products as $p)
        <div class="{{ $p->promoted ? "wide col-sm-12" : "small col-sm-6 col-lg-4" }}">
            <a
                href="/store/product/{{ $p->product_id }}"
                class="product-box product-box--{{ $p->promoted ? 'large' : 'small' }}"
                style="background-image: url('{{ $p->promoted ? $p->header_image : $p->image }}')"
            >
                <div class="product-box__text product-box__text--{{ $p->promoted === true ? 'large' : 'small' }}">
                    {!! Markdown::convertToHtml($p->header_description) !!}
                </div>

                @if(!$p->inStock(1, true))
                    <i class="product-box__bar product-box__bar--oos"></i>
                @endif
            </a>
        </div>
        @endforeach
    </div>
@stop
