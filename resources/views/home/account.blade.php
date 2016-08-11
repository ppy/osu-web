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

                <span class="user-header__text user-header__text--large">
                    <span class="user-header__text user-header__text--large user-header__text--bold">
                        {{ trans('users.settings.account') }}
                    </span>
                    {{ trans('users.settings.settings') }}
                </span>

                @include('layout.user-notifications')
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 user-prefs-section">
            <div class="user-prefs-section__left">
                <div class="user-prefs-section__text">{{ trans('users.settings.profile') }}</div>
                <div class="user-prefs-section__text user-prefs-section__text--small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
            </div>
            <div class="user-prefs-section__right">
                @each('layout._user-prefs-section', [
                    ['skype', 'twitter', 'website'],
                    ['location', 'occupation'],
                    ['interest'],
                ], 'elements')
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 user-prefs-section">
            <div class="user-prefs-section__left">
                <div class="user-prefs-section__text">{{ trans('users.settings.avatar') }}</div>
                <div class="user-prefs-section__text user-prefs-section__text--small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
            </div>

            <div class="user-prefs-section__right">
                <div class="user-prefs-section__right-section user-prefs-section__right-section--avatar">
                    <div
                        class="avatar avatar--user-prefs"
                        style="background-image: url({{ $user->user_avatar }});"
                    ></div>

                    <a href="#" class="btn-osu-big user-prefs-section__button">
                        <div class="btn-osu-big__content">
                            <span class="user-prefs-section__button-text">{{ trans('users.settings.upload') }}</span>
                            <span class="fa fa-angle-double-up"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 user-prefs-section">
            <div class="user-prefs-section__left">
                <div class="user-prefs-section__text">{{ trans('users.settings.fluffs') }}</div>
                <div class="user-prefs-section__text user-prefs-section__text--small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
            </div>

            <div class="user-prefs-section__right">
                @include('layout._user-prefs-section', ['elements' => ['brand', 'model', 'surface']])
            </div>
        </div>
    </div>
@endsection
