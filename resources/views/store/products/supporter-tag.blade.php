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
@if(!Auth::user())
<div class="grid grid--gutters">
    <div class="grid-cell grid-cell--1of2">
        You need to be <a href="#" class="js-user-link" title="{{ trans("users.anonymous.login_link") }}">logged in</a> to stuff!
    </div>
</div>
@else
<div id="js-store-supporter-tag" class="js-store-supporter-tag store-supporter-tag"
    data-username="{{ Auth::user()->username }}" data-avatar-url="{{ Auth::user()->user_avatar }}">
    <input type="hidden" name="item[product_id]" value="{{ $product->product_id }}" />
    <input type="hidden" name="item[quantity]" class="js-store-item-quantity" value="1" />
    <input type="hidden" id="supporter-tag-form-price" name="item[cost]" value="4" />
    <input type="hidden" name="item[extra_data][type]" value="supporter-tag" />
    <input type="hidden" name="item[extra_data][duration]" value="1" />
    <div class="store-supporter-tag__user-icon">
        <center>
            <div style="background-image: url('{{ Auth::user()->user_avatar }}');" class="avatar js-avatar"></div>
        </center>
    </div>
    <div class="grid grid--xs grid--centered grid--stack store-supporter-tag__user-search">
        <div class="grid-cell">
            {!! Form::text('item[extra_data][username]', Auth::user()->username, ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'Enter a username', 'autocomplete' => 'off']) !!}
        </div>
        <div class="grid-cell">
            <div class="js-input-feedback"></div>
        </div>
    </div>
    <div class="store-supporter-tag__slider">
        <div class="js-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content">
            <div class="ui-slider-handle">
                <div class="slider-callout arrow-box">
                    <div class="js-price price"></div>
                    <div class="js-duration"></div>
                    <div class="js-discount"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
