{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $class = 'avatar
        avatar--nav2
        js-click-menu
        js-user-login--menu
        js-user-header';
    $currentUser ??= Auth::user();
@endphp
@if ($currentUser === null)
    <button
        class="{{ $class }} avatar--guest"
        data-click-menu-target="nav2-login-box"
        title="{{ osu_trans('users.anonymous.login_link') }}"
    ></button>
@else
    <a
        class="{{ $class }} {{ $currentUser->isRestricted() ? 'avatar--restricted' : '' }} u-current-user-avatar"
        data-click-menu-target="nav2-user-popup"
        href="{{ route('users.show', $currentUser) }}"
    ></a>
@endif
