{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="js-header--main {{ class_with_modifiers('header-v4', $modifiers) }}">
    <div class="header-v4__bg-container">
        <div
            class="header-v4__bg js-forum-cover--header"
            {!! background_image($background ?? null, false) !!}
        ></div>
    </div>

    <div class="header-v4__content">
        <div class="header-v4__row header-v4__row--title">
            <div class="header-v4__icon"></div>
            <div class="header-v4__title">
                <span class="header-v4__title-section">
                    {{ trans('layout.header.community._') }}
                </span>
                <span class="header-v4__title-action">
                    {{ trans('layout.header.community.forum') }}
                </span>
            </div>
        </div>

        <div class="header-v4__row header-v4__row--bar">
            @include('forum._header_breadcrumb')
        </div>
    </div>
</div>
