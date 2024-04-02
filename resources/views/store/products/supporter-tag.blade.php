{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\Store\ExtraDataSupporterTag;
@endphp

@if(!Auth::user())
    {!! require_login('store.supporter_tag.require_login._', 'store.supporter_tag.require_login.link_text') !!}
@else
    <div
        class="js-react--store-supporter-tag"
        data-product-id={{ $product->product_id }}
        data-max-message-length={{ ExtraDataSupporterTag::MAX_MESSAGE_LENGTH }}
    ></div>
@endif
