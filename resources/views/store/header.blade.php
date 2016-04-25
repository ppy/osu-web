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
<div class="osu-layout__row osu-layout__row--page-compact header-row no-print">
    <div class="store-header">
        <div class="store-header__main">
            @if ((new Carbon\Carbon("2015-07-15"))->isFuture())
                <a href="{{ action("StoreController@getListing") }}" class="store-logo--late"></a>
            @else
                <a href="{{ action("StoreController@getListing") }}" class="store-logo">
                    @include("store._logo")
                </a>
            @endif

            @if(!isset($skip_back_link))
                <div class="store-header__float store-header__float--left">
                    <a href="javascript:history.back()" class="store-header__float-link">
                        <span class="store-header__float-link-text store-header__float-link-text--icon">
                            <i class="fa fa-chevron-left"></i>
                        </span>

                        <span class="store-header__float-link-text">
                            back
                        </span>
                    </a>
                </div>
            @endif

            @if(isset($cart) && $cart && $cart->items()->exists())
                <div class="store-header__float store-header__float--right">
                    <a href="/store/cart" class="store-header__float-link">
                        <span class="store-header__float-link-text">
                            {{ $cart->getItemCount() }} item(s) in cart (${{ $cart->getSubtotal() }})
                        </span>

                        <span class="store-header__float-link-text store-header__float-link-text--icon">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                    </a>
                </div>
            @endif
        </div>

        @if (config('osu.store.notice') !== null)
            <div class="store-header__notice">
                <h2 class="store-header__notice-text store-header__notice-text--title">
                    {{ trans('common.title.notice') }}
                </h2>

                <div class="store-header__notice-text">
                    {!! Markdown::convertToHtml(config('osu.store.notice')) !!}
                </div>
            </div>
        @endif
    </div>
</div>
