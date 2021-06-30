{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
        <div class="js-react--user-card-store"></div>
        <div class="grid-cell grid-cell--store-user-search">
            {!!
                Form::text(
                    'item[extra_data][username]',
                    null,
                    [
                        'id' => 'username',
                        'class' => 'js-username-input store-supporter-tag__input',
                        'placeholder' => osu_trans('store.supporter_tag.gift'),
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
            <span class="store-slider__presets-blurb">{{ osu_trans('supporter_tag.months') }}</span>
            @foreach([1, 2, 4, 6, 12, 18, 24] as $months)
                <div class="js-slider-preset store-slider__preset" data-months="{{$months}}">{{$months}}</div>
            @endforeach
        </div>
    </div>
</div>
@endif
