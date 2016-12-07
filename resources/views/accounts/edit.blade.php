{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends('master')

@section('content')
    <div class="osu-page osu-page--account-edit-header">
        @include('home._user_header_nav')

        <div class="osu-page-header osu-page-header--home-user js-current-user-cover">
            <div class="osu-page-header__box">
                <h1 class="osu-page-header__title osu-page-header__title--slightly-small">
                    {{ trans('accounts.edit.title') }}
                </h1>
            </div>
        </div>
    </div>

    <div class="osu-page osu-page--small">
        <div class="account-edit">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ trans('accounts.edit.profile.title') }}
                </h2>

                <p class="account-edit__section-description">
                    {{ trans('accounts.edit.profile.description') }}
                </p>
            </div>

            <div class="account-edit__forms">
                <div class="account-edit__form">
                    <label class="account-edit__input-group">
                        <span class="account-edit__label">
                            {{ trans('accounts.edit.profile.user.user_msnm') }}
                        </span>

                        <input class="account-edit__input" name="user[user_msnm]">
                    </label>
                </div>

                <div class="account-edit__form">
                    <label class="account-edit__input-group">
                        <span class="account-edit__label">
                            {{ trans('accounts.edit.profile.user.user_msnm') }}
                        </span>

                        <input class="account-edit__input" name="user[user_msnm]">
                    </label>
                </div>
            </div>
        </div>
    </div>
@endsection
