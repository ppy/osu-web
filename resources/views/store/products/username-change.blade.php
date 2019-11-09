{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
            {!! Form::text('item[extra_info]', '', ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'Requested Username', 'autocomplete' => 'off']) !!}
        </div>
        <strong>
            <div id="username-check-status">{{ trans('store.username_change.check') }}</div>
        </strong>
        <div>Your current username is "<i>{{ Auth::user()->username }}</i>".</div>
    </div>
    <div class="grid-cell price-box">
        <p class="price" id="username-check-price"></p>
    </div>
</div>
@endif
