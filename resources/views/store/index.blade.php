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
        <div class="{{{ $p->promoted ? "wide col-sm-12" : "small col-sm-6 col-lg-4" }}}">
            <div class="product-box" style="background-image: url('{{{ $p->promoted ? $p->header_image : $p->image}}}')">
                <a href="/store/product/{{{$p->product_id}}}">
                    {!! Markdown::convertToHtml($p->header_description) !!}
                    @if(!$p->inStock())
                    <i class="product-oos product-bar"></i>
                    @endif
                </a>
            </div>
        </div>
        @endforeach

        <div class="small col-sm-6 col-lg-4">
            <div style="background-image: url(//puu.sh/8Bj8T/d6009fc9ee.png)">
                <div>
                    <h1>More to come!</h1>
                    <p class="always-visible">We're just getting started... <strong>check back soon!</strong></p>
                </div>
            </div>
        </div>
    </div>
@stop
