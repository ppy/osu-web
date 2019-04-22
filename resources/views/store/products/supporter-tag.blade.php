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
        {!! require_login('store.supporter_tag.require_login._', 'store.supporter_tag.require_login.link_text') !!}
    </div>
</div>
@else
<div class="js-store js-store-supporter-tag store-supporter-tag">
    <input type="hidden" name="item[product_id]" value="{{ $product->product_id }}" />
    <input type="hidden" name="item[quantity]" class="js-store-item-quantity" value="1" />
    <input type="hidden" id="supporter-tag-form-price" name="item[cost]" value="4" />
    <input type="hidden" name="item[extra_data][target_id]" value="{{ Auth::user()->user_id }}" />
    <div class="store-supporter-tag__user-search">
        <div class="js-react--user-card-store"
            data-user="{{ json_encode(json_item(auth()->user(), 'UserCompact', ['cover', 'country'])) }}">
        </div>
        <div class="grid-cell grid-cell--store-user-search">
            {!!
                Form::text(
                    'item[extra_data][username]',
                    null,
                    [
                        'id' => 'username',
                        'class' => 'js-username-input store-supporter-tag__input',
                        'placeholder' => trans('store.supporter_tag.gift'),
                        'autocomplete' => 'off'
                    ]
                )
            !!}
        </div>
    </div>
    <div class="store-slider">
        <div class="js-slider ui-slider ui-slider-horizontal">
            <div class="ui-slider-handle">
                <div class="store-slider__fake-callout">
                    <div class="store-slider__callout">
                        <div class="js-price store-slider__bigtext"></div>
                        <div class="js-duration"></div>
                        <div class="js-discount store-slider__subtext"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid--xs grid--right store-slider__presets">
            <span class="store-slider__presets-blurb">{{ trans('supporter_tag.months') }}</span>
            @foreach([1, 2, 4, 6, 12, 18, 24] as $months)
                <div class="js-slider-preset store-slider__preset" data-months="{{$months}}">{{$months}}</div>
            @endforeach
        </div>
    </div>
</div>
@endif
