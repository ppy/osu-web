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
            {!! Form::text('item[extra_info]', '', [
                'id' => 'username',
                'class' => 'js-username-change-input form-text form-text--username-change',
                'placeholder' => 'Requested Username',
                'autocomplete' => 'off',
            ]) !!}
        </div>
        <em class="store-text store-text--emphasis">
            <div id="username-check-status">{{ osu_trans('store.username_change.check') }}</div>
        </em>
        <div>Your current username is "{{ Auth::user()->username }}".</div>
    </div>
    <div class="grid-cell">
        <p class="store-text store-text--price" id="username-check-price"></p>
    </div>
</div>
@endif
