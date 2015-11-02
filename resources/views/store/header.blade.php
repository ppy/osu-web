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
<div class="row-page header-row no-print" id="store-header">
    {{--
    * setting `display: flex` on main row div breaks width on
    * several browsers (IE11, Firefox 36)
    --}}
    <div>
        @if ((new Carbon\Carbon("2015-07-15"))->isFuture())
            <a href="{{ action("StoreController@getListing") }}" class="store-logo--late"></a>
        @else
            <a href="{{ action("StoreController@getListing") }}" id="store-logo">
                @include("store._logo")
            </a>
        @endif

        @if(!isset($skip_back_link))
            <div class="float float-left">
                <a href="javascript:history.back()" class="float-link">
                    <i class="fa fa-chevron-left"></i>
                    <span>back</span>
                </a>
            </div>
        @endif

        @if(isset($cart) && $cart && $cart->items()->exists())
            <div class="float float-right">
                <a href="/store/cart" class="float-link">
                    <span>{{{$cart->getItemCount()}}} item(s) in cart (${{{$cart->getSubtotal()}}})</span>
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </div>
        @endif
    </div>
</div>
