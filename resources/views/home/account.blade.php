{{--
    Copyright 2015-2016 ppy Pty. Ltd.

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
@extends('master', [
    'hideAction' => true
])

@section('content')
    <div class="osu-layout__section">
        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--marginless">
            @include('layout.user-subnav')
            <div
                class="user-header"
                style="background-image: url({{ $user->profileCustomization->cover->url() }});"
            >
                <div class="user-header__overlay"></div>

                <div class="user-header__text-box">
                    <span class="user-header__text user-header__text--large">
                        <span class="user-header__text user-header__text--large user-header__text--bold">
                            {{ trans('users.settings.account') }}
                        </span>
                        {{ trans('users.settings.settings') }}
                    </span>

                    @include('layout._user-notifications')
                </div>

                @include('layout._users-active-chart')
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 user-prefs-section">
            <div class="user-prefs-section__left">
                <div class="user-prefs-section__text">{{ trans('users.settings.profile') }}</div>
            </div>
            <div class="user-prefs-section__right">
                @include('layout._user-prefs-section', ['elements' => ['user_msnm', 'user_twitter', 'user_website']])
                @include('layout._user-prefs-section', ['elements' => ['user_from', 'user_occ']])
                @include('layout._user-prefs-section', ['elements' => ['user_interests']])
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 user-prefs-section">
            <div class="user-prefs-section__left">
                <div class="user-prefs-section__text">{{ trans('users.settings.avatar') }}</div>
            </div>

            <div class="user-prefs-section__right">
                <div class="js-react--avatar-upload"></div>
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 user-prefs-section">
            <div class="user-prefs-section__left">
                <div class="user-prefs-section__text">{{ trans('users.settings.fluffs') }}</div>
            </div>

            <div class="user-prefs-section__right">
                @include('layout._user-prefs-section', ['elements' => ['tablet_brand', 'tablet_model', 'tablet_surface']])
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent

    <script id="json-avatar" type="application/json">
        {"avatarUrl": {!! json_encode($user->profileCustomization->avatar->url()) !!}}
    </script>

    <script id="json-stats" type="application/json">
        {!! json_encode($stats) !!}
    </script>

    <script src="{{ elixir('js/react/misc/avatar-upload.js') }}" data-turbolinks-track></script>
@endsection
