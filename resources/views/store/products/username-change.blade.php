{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
        {!! require_login('store.username_change.require_login._', 'store.username_change.require_login.link_text') !!}
    </div>
</div>
@else
<div class="js-username-change grid grid--gutters">
    <div class="grid-cell grid-cell--squash">
        <div style="background-image: url('{{ Auth::user()->user_avatar }}');" class="avatar avatar--centered"></div>
    </div>
    <div class="grid-cell">
        <div>
            <input type="hidden" name="item[product_id]" value="{{ $product->product_id }}" />
            <input type="hidden" name="item[quantity]" class="js-store-item-quantity" value="1" />
            <input type="hidden" id="username-form-price" name="item[cost]" value="0" />
            {!! Form::label('username', 'New Username') !!}
            {!! Form::text('item[extra_info]', '', [
                'id' => 'username',
                'class' => 'js-username-change-input form-text form-text--username-change',
                'placeholder' => 'Requested Username',
                'autocomplete' => 'off',
            ]) !!}
        </div>
        <em class="store-text store-text--emphasis">
            <div id="username-check-status">{{ trans('store.username_change.check') }}</div>
        </em>
        <div>Your current username is "{{ Auth::user()->username }}".</div>
    </div>
    <div class="grid-cell">
        <p class="store-text store-text--price" id="username-check-price"></p>
    </div>
</div>
@endif
