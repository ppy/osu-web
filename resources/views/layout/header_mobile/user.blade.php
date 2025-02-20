{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentUser ??= Auth::user();
    $teamId = $currentUser->team?->getKey() ?? $currentUser->teamApplication?->team_id;
@endphp
<div class="navbar-mobile-item js-click-menu--close">
    @if ($currentUser === null)
        <a
            class="js-user-link navbar-mobile-item__main navbar-mobile-item__main--user"
            href="#"
            title="{{ osu_trans('users.anonymous.login_link') }}"
        >
            <span class="avatar avatar--guest avatar--navbar-mobile"></span>

            {{ osu_trans('users.anonymous.username') }}
        </a>
    @else
        <div
            class="navbar-mobile-item__main js-react--user-card"
            data-is-current-user="1"
        ></div>

        @include('layout._score_mode_toggle', ['class' => 'navbar-mobile-item__main'])

        <a
            class="navbar-mobile-item__main"
            href="{{ route('users.show', $currentUser) }}"
        >
            {{ osu_trans('layout.popup_user.links.profile') }}
        </a>

        @if ($teamId === null)
            <a class="navbar-mobile-item__main" href="{{ route('teams.create') }}">
                {{ osu_trans('layout.popup_user.links.team') }}
            </a>
        @else
            <a class="navbar-mobile-item__main" href="{{ route('teams.show', ['team' => $teamId]) }}">
                {{ osu_trans('layout.popup_user.links.team') }}
            </a>
        @endif

        <a class="navbar-mobile-item__main" href="{{ route('friends.index') }}">
            {{ osu_trans('layout.popup_user.links.friends') }}
        </a>

        <a class="navbar-mobile-item__main" href="{{ route('follows.index', ['subtype' => App\Models\Follow::DEFAULT_SUBTYPE]) }}">
            {{ osu_trans('layout.popup_user.links.follows') }}
        </a>

        <a class="navbar-mobile-item__main" href="{{ route('account.edit') }}">
            {{ osu_trans('layout.popup_user.links.account-edit') }}
        </a>

        <button
            class="js-logout-link navbar-mobile-item__main"
            type="button"
            data-url="{{ route('logout') }}"
            data-confirm="{{ osu_trans('users.logout_confirm') }}"
            data-method="delete"
            data-remote="1"
        >
            {{ osu_trans('layout.popup_user.links.logout') }}
        </button>
    @endif
</div>
