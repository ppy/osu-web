{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="{{ class_with_modifiers('login-box', $modifiers ?? []) }}">
    <div
        class="
            login-box__content
            js-click-menu
            js-nav2--centered-popup
            js-nav2--login-box
        "
        data-click-menu-id="nav2-login-box"
        data-visibility="hidden"
    >
        {!! Form::open([
            'url' => route('login'),
            'class' => '
                login-box__section
                login-box__section--login
                js-login-form
                js-nav-popup--submenu
            ',
            'data-remote' => true,
        ]) !!}
            <h2 class="login-box__row login-box__row--title">{{ trans('layout.popup_login.login.title') }}</h2>

            <div class="login-box__row login-box__row--inputs">
                <input
                    class="login-box__form-input js-login-form-input js-nav2--autofocus"
                    name="username"
                    placeholder="{{ trans('layout.popup_login.login.email') }}"
                    required
                />
                <input
                    class="login-box__form-input js-login-form-input"
                    name="password"
                    type="password"
                    placeholder="{{ trans('layout.popup_login.login.password') }}"
                    required
                />
            </div>

            <div class="login-box__row login-box__row--error js-login-form--error"></div>

            <div class="login-box__row">
                <a href="{{ route('password-reset') }}" class="login-box__link js-nav--hide">
                    {{ trans('layout.popup_login.login.forgot') }}
                </a>
            </div>

            <div class="login-box__row login-box__row--actions">
                <div class="login-box__action">
                    <button
                        class="btn-osu-big btn-osu-big--nav-popup"
                        data-disable-with="{{ trans('users.login.button_posting') }}"
                    >
                        <div class="btn-osu-big__content">
                            <span class="btn-osu-big__left">
                                {{ trans('users.login._') }}
                            </span>

                            <span class="fas fa-fw fa-sign-in-alt"></span>
                        </div>
                    </button>
                </div>
            </div>
        {!! Form::close() !!}

        <div class="login-box__section login-box__section--register">
            <h2 class="login-box__row login-box__row--title">
                {{ trans('layout.popup_login.register.title') }}
            </h2>

            <div class="login-box__row">
                {{ trans('layout.popup_login.register.info') }}
            </div>

            <div class="login-box__row login-box__row--actions">
                <div class="login-box__action">
                    <a href="{{ route('download') }}" class="btn-osu-big btn-osu-big--nav-popup">
                        <div class="btn-osu-big__content">
                            <span class="btn-osu-big__left">
                                {{ trans('layout.popup_login.register.download') }}
                            </span>

                            <span class="fas fa-fw fa-download"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
