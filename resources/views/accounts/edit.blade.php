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
        <div class="account-edit account-edit--first">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ trans('accounts.edit.profile.title') }}
                </h2>
            </div>

            <div class="account-edit__input-groups">
                <div class="account-edit__input-group">
                    @include('accounts._edit_entry_simple', ['field' => 'user_msnm'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_twitter'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_website'])
                </div>

                <div class="account-edit__input-group">
                    @include('accounts._edit_entry_simple', ['field' => 'user_from'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_occ'])
                </div>

                <div class="account-edit__input-group">
                    @include('accounts._edit_entry_simple', ['field' => 'user_interests'])
                </div>
            </div>
        </div>
    </div>

    <div class="osu-page osu-page--small">
        <div class="account-edit">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ trans('accounts.edit.avatar.title') }}
                </h2>
            </div>

            <div class="account-edit__input-groups">
                <div class="account-edit__input-group">
                    <div class="account-edit-entry js-account-edit-avatar">
                        <div class="account-edit-entry__label"></div>

                        <div>
                            <div class="account-edit-entry__avatar">
                                <div class="avatar avatar--full-rounded js-current-user-avatar"></div>

                                <div class="account-edit-entry__drop-overlay">
                                    <span>
                                    {{ trans('common.dropzone.target') }}
                                    </span>
                                </div>

                                <div class="account-edit-entry__overlay-spinner">
                                    @include('objects._spinner')
                                </div>
                            </div>

                            <label class="btn-osu-big btn-osu-big--full">
                                <div class="btn-osu-big__content">
                                    <div class="btn-osu-big__left">
                                        {{ trans('common.buttons.upload_image') }}
                                    </div>

                                    <div class="btn-osu-big__icon">
                                        <i class="fa fa-arrow-circle-o-up"></i>
                                    </div>
                                </div>

                                <input
                                    class="js-account-edit-avatar__button btn-osu-big__fileupload"
                                    type="file"
                                    name="avatar_file"
                                    data-url="{{ route('account.avatar') }}"
                                >
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
