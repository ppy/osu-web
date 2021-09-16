{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@include('layout._header_mobile')

<div
    class="
    js-pinned-header
    hidden-xs
    no-print
    nav2-header
">
    <div class="nav2-header__body">
        <div class="nav2-header__menu-bg js-nav2--menu-bg" data-visibility="hidden"></div>
        <div class="nav2-header__triangles"></div>
        <div class="nav2-header__transition-overlay"></div>

        <div class="osu-page">
            @include('layout._nav2')
        </div>
    </div>
    @include('layout._sticky_header')
</div>

@if (Auth::user() === null)
    @include('layout._popup_login')
@endif


<div class="js-user-verification--reference"></div>
@include('layout._user_verification_popup')
