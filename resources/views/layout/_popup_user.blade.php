{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentUser = Auth::user();
    $currentUserUrl = route('users.show', ['user' => $currentUser->getKey()]);
@endphp
<div
    class="simple-menu simple-menu--nav2 js-click-menu js-nav2--centered-popup"
    data-click-menu-id="nav2-user-popup"
    data-visibility="hidden"
>
    <a
        href="{{ $currentUserUrl  }}"
        class="simple-menu__header simple-menu__header--link js-current-user-cover"
        {!! background_image($currentUser->cover()->url(), false) !!}
    >
        <img class="simple-menu__header-icon" src="/images/icons/profile.svg" alt="">
        <div class="u-relative">{{ $currentUser->username }}</div>
    </a>

    <div class="simple-menu__extra">
        @include('layout._score_mode_toggle', ['class' => 'simple-menu__item'])
    </div>

    <a
        class="simple-menu__item"
        href="{{ $currentUserUrl }}"
    >
        {{ osu_trans('layout.popup_user.links.profile') }}
    </a>

    @if (($team = $currentUser->team) !== null)
        <a class="simple-menu__item" href="{{ route('teams.show', $team) }}">
            {{ osu_trans('layout.popup_user.links.team') }}
        </a>
    @endif

    <a class="simple-menu__item" href="{{ route('friends.index') }}">
        {{ osu_trans('layout.popup_user.links.friends') }}
    </a>

    <a class="simple-menu__item" href="{{ route('follows.index', ['subtype' => App\Models\Follow::DEFAULT_SUBTYPE]) }}">
        {{ osu_trans('layout.popup_user.links.follows') }}
    </a>

    <a class="simple-menu__item" href="{{ route('account.edit') }}">
        {{ osu_trans('layout.popup_user.links.account-edit') }}
    </a>

    <button
        class="js-logout-link simple-menu__item"
        type="button"
        data-url="{{ route('logout') }}"
        data-confirm="{{ osu_trans('users.logout_confirm') }}"
        data-method="delete"
        data-remote="1"
    >
        {{ osu_trans('layout.popup_user.links.logout') }}
    </button>
</div>
