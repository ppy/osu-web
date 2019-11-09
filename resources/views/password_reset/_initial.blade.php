{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! Form::open([
    'route' => 'password-reset',
    'class' => 'password-reset js-form-error',
    'method' => 'POST',
    'data-remote' => true,
    'data-reload-on-success' => '1',
    'data-skip-ajax-error-popup' => '1',
]) !!}
    <label class="password-reset__input-group">
        {{ trans('password_reset.starting.username') }}

        <input name="username" class="password-reset__input" autofocus>

        <span class="password-reset__error js-form-error--error"></span>
    </label>

    <div class="password-reset__input-group">
        <button class="btn-osu-big btn-osu-big--password-reset">
            {{ trans('password_reset.button.start') }}
        </button>
    </div>

    @if (config('services.enchant.id') !== null)
        <div>
            {!! trans('password_reset.starting.support._', ['button' => tag('a', [
                'class' => 'link link--default js-enchant--show',
                'role' => 'button',
                'href' => '#',
            ], trans('password_reset.starting.support.button'))]) !!}
        </div>

        <div class="enchant-help-center" data-id="{{ config('services.enchant.id') }}"></div>
    @endif
{!! Form::close() !!}
