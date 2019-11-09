{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div
    class="simple-menu simple-menu--nav2 js-click-menu js-nav2--centered-popup"
    data-click-menu-id="nav2-user-popup"
    data-visibility="hidden"
>
    <a
        href="{{ route('users.show', Auth::user()) }}"
        class="simple-menu__header simple-menu__header--link js-current-user-cover"
        {!! background_image(Auth::user()->cover(), false) !!}
    >
        <img class="simple-menu__header-icon" src="/images/icons/profile.svg" alt="">
        <div>{{ Auth::user()->username }}</div>
    </a>

    <a
        class="simple-menu__item"
        href="{{ route('users.show', Auth::user()) }}"
    >
        {{ trans('layout.popup_user.links.profile') }}
    </a>

    <a class="simple-menu__item" href="{{ route('friends.index') }}">
        {{ trans('layout.popup_user.links.friends') }}
    </a>

    <a class="simple-menu__item" href="{{ route('account.edit') }}">
        {{ trans('layout.popup_user.links.account-edit') }}
    </a>

    <button
        class="js-logout-link simple-menu__item"
        type="button"
        data-url="{{ route('logout') }}"
        data-confirm="{{ trans('users.logout_confirm') }}"
        data-method="delete"
        data-remote="1"
    >
        {{ trans('layout.popup_user.links.logout') }}
    </button>
</div>
