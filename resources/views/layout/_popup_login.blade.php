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
<div class="nav-popup nav-popup--sections">
    <div class="nav-popup__section nav-popup__section--register">
        <h2 class="nav-popup__row nav-popup__row--title">{{ trans('layout.popup_login.register.title') }}</h2>

        <div class="nav-popup__row nav-popup__row--full">{{ trans('layout.popup_login.register.info') }}</div>

        <div class="nav-popup__row nav-popup__row--actions nav-popup__row--with-gutter">
            <div class="nav-popup__action"></div>

            <div class="nav-popup__action">
                <a href="#" class="btn-osu-big">
                    <div class="btn-osu-big__content">
                        <span class="btn-osu-big__left">
                            {{ trans('layout.popup_login.register.do') }}
                        </span>

                        <span class="fa fa-pencil-square-o"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {!! Form::open([
        'url' => route('users.login'),
        'class' => '
            nav-popup__section
            nav-popup__section--login
            js-login-form
        ',
        'data-remote' => true,
    ]) !!}
        <h2 class="nav-popup__row nav-popup__row--title">{{ trans('layout.popup_login.login.title') }}</h2>

        <div class="nav-popup__row nav-popup__row--full nav-popup__row--error js-login-form--error"></div>

        <div class="nav-popup__row nav-popup__row--with-gutter nav-popup__row--xs-vertical">
            <input
                class="nav-popup__form-input js-nav-auto-focus"
                name="username"
                placeholder="{{ trans('layout.popup_login.login.email') }}"
            />
            <input
                class="nav-popup__form-input"
                name="password"
                type="password"
                placeholder="{{ trans('layout.popup_login.login.password') }}"
            />
        </div>

        <div class="nav-popup__row nav-popup__row--actions nav-popup__row--with-gutter">
            <div class="nav-popup__action">
                <a href="#" class="nav-popup__link">{{ trans('layout.popup_login.login.forgot') }}</a>
            </div>

            <div class="nav-popup__action">
                <button class="btn-osu-big">
                    <div class="btn-osu-big__content">
                        <span class="btn-osu-big__left">
                            {{ trans('layout.popup_login.login.do') }}
                        </span>

                        <span class="fa fa-sign-in"></span>
                    </div>
                </button>
            </div>
        </div>
    {!! Form::close() !!}

    <div class="nav-popup__bar">
        <span class="bar u-section-bg"></span>
    </div>
</div>
